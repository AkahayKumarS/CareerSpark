import React from "react";
import { Button } from "./ui/button";
import { Download } from "lucide-react";
import { useResume } from "../contexts/ResumeContext";
import { toast } from "./ui/use-toast";
import html2canvas from "html2canvas";
import jsPDF from "jspdf";

const PDFDownloader = () => {
  const { resumeData } = useResume();
  const { personalInfo } = resumeData;

  const generatePDF = async () => {
    toast({
      title: "Preparing your resume...",
      description: "Please wait while we generate your PDF",
    });

    try {
      // Target the resume preview element
      const resumeElement = document.querySelector(".resume-preview");

      if (!resumeElement) {
        throw new Error("Could not find resume preview element");
      }

      // Create a temporary clone of the resume with fixed dimensions for PDF generation
      const tempContainer = document.createElement("div");
      tempContainer.style.position = "absolute";
      tempContainer.style.left = "-9999px";
      tempContainer.style.width = "210mm"; // A4 width
      tempContainer.style.height = "auto"; // Auto height to fit content
      tempContainer.style.backgroundColor = "white";
      tempContainer.innerHTML = resumeElement.innerHTML;
      document.body.appendChild(tempContainer);

      // Use html2canvas to capture the resume with higher quality
      const canvas = await html2canvas(tempContainer, {
        scale: 2, // Higher scale for better quality
        useCORS: true,
        allowTaint: true,
        backgroundColor: "#ffffff",
        logging: false,
        // Ensure entire content is captured
        windowWidth: tempContainer.scrollWidth,
        windowHeight: tempContainer.scrollHeight,
      });

      // Remove the temporary container
      document.body.removeChild(tempContainer);

      // Create PDF with A4 dimensions (210 x 297 mm)
      const imgWidth = 210; // mm
      const pageHeight = 297; // mm
      const imgHeight = (canvas.height * imgWidth) / canvas.width;
      const pdf = new jsPDF("p", "mm", "a4");

      // Add the image to the PDF, maintaining aspect ratio
      let position = 0;

      // If content fits on one page
      if (imgHeight < pageHeight) {
        pdf.addImage(
          canvas.toDataURL("image/png", 1.0),
          "PNG",
          0,
          0,
          imgWidth,
          imgHeight
        );
      } else {
        // Multi-page handling for longer resumes
        let heightLeft = imgHeight;
        let currentPosition = 0;

        while (heightLeft > 0) {
          pdf.addImage(
            canvas.toDataURL("image/png", 1.0),
            "PNG",
            0,
            currentPosition < 0 ? currentPosition : 0,
            imgWidth,
            imgHeight
          );

          heightLeft -= pageHeight;
          currentPosition -= pageHeight;

          if (heightLeft > 0) {
            pdf.addPage();
          }
        }
      }

      // Generate a filename based on the user's name and current date
      const fileName = `${personalInfo.fullName.replace(/\s+/g, "_")}_Resume_${
        new Date().toISOString().split("T")[0]
      }.pdf`;

      // Save the PDF
      pdf.save(fileName);

      toast({
        title: "Download successful!",
        description: `Your resume has been saved as ${fileName}`,
      });
    } catch (error) {
      console.error("Error generating PDF:", error);
      toast({
        title: "Error generating PDF",
        description:
          "There was a problem creating your resume PDF. Please try again.",
        variant: "destructive",
      });
    }
  };

  return (
    <Button
      onClick={generatePDF}
      className="bg-resume-teal hover:bg-resume-teal-dark"
    >
      <Download className="h-4 w-4 mr-1" />
      Download PDF
    </Button>
  );
};

export default PDFDownloader;
