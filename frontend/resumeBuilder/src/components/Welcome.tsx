import React, { useState } from "react";
import { Button } from "@/components/ui/button";
import { useResume } from "../contexts/ResumeContext";
import { templates } from "../data/templates";
import FileUploader from "./FileUploader";
import { ChevronRight } from "lucide-react";

interface WelcomeProps {
  onStart: () => void;
}

const Welcome = ({ onStart }: WelcomeProps) => {
  const { changeTemplate } = useResume();
  const [selectedTemplate, setSelectedTemplate] = useState(templates[0].id);
  const [step, setStep] = useState<"welcome" | "upload" | "template">(
    "welcome"
  );

  const handleTemplateSelect = (templateId: string) => {
    setSelectedTemplate(templateId);
  };

  const handleContinue = () => {
    changeTemplate(selectedTemplate);
    onStart();
  };

  return (
    <div
      className={`flex items-center justify-center bg-gray-50 ${
        step === "welcome" ? "p-40" : "p-14"
      }`}
    >
      <div className="bg-white rounded-xl shadow-lg overflow-hidden max-w-4xl w-full">
        {step === "welcome" && (
          <div className="p-10 text-center">
            <h1 className="text-2xl font-bold mb-2">
              Welcome to CareerSpark Resume Builder
            </h1>
            <p className="text-gray-600 mb-4">
              Create professional, customizable resumes in minutes
            </p>

            <div className="flex flex-col md:flex-row gap-4 justify-center">
              <Button
                className="bg-resume-teal hover:bg-resume-teal-dark text-white px-4 py-4 h-auto w-full md:w-48 flex flex-col items-center gap-1"
                onClick={() => setStep("upload")}
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  className="h-8 w-8"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    strokeWidth={2}
                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"
                  />
                </svg>
                <span className="font-semibold text-sm">Upload Resume</span>
              </Button>

              <Button
                variant="outline"
                className="border-resume-teal text-resume-teal hover:bg-resume-teal hover:text-white px-4 py-4 h-auto w-full md:w-48 flex flex-col items-center gap-1"
                onClick={() => setStep("template")}
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  className="h-8 w-8"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    strokeWidth={2}
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                  />
                </svg>
                <span className="font-semibold text-sm">
                  Start with Templates
                </span>
              </Button>
            </div>
          </div>
        )}

        {step === "upload" && (
          <div className="p-4">
            <button
              className="flex items-center text-resume-teal mb-2"
              onClick={() => setStep("welcome")}
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                className="h-4 w-4 mr-1"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  strokeWidth={2}
                  d="M15 19l-7-7 7-7"
                />
              </svg>
              Back
            </button>

            <h2 className="text-xl font-bold mb-2">Upload Your Resume Data</h2>
            <p className="text-gray-600 mb-4">
              Upload a JSON or CSV file to import your resume data.
            </p>

            <FileUploader />

            <div className="mt-4 text-center">
              <Button
                className="bg-resume-teal hover:bg-resume-teal-dark text-white px-6"
                onClick={handleContinue}
              >
                Continue <ChevronRight className="ml-1 h-4 w-4" />
              </Button>
            </div>
          </div>
        )}

        {step === "template" && (
          <div>
            <div className="p-4 pb-2">
              <button
                className="flex items-center text-resume-teal mb-2"
                onClick={() => setStep("welcome")}
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  className="h-4 w-4 mr-1"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    strokeWidth={2}
                    d="M15 19l-7-7 7-7"
                  />
                </svg>
                Back
              </button>

              <h2 className="text-xl font-bold mb-2">Choose a Template</h2>
              <p className="text-gray-600 mb-4">
                Select a design that fits your style. You can always change it
                later.
              </p>
            </div>

            <div className="px-4 overflow-x-auto pb-2">
              <div className="flex space-x-2">
                {templates.map((template) => (
                  <div
                    key={template.id}
                    className={`cursor-pointer flex-shrink-0 w-40 border rounded-lg overflow-hidden ${
                      selectedTemplate === template.id
                        ? "border-resume-teal-dark border-2"
                        : "border-gray-200"
                    }`}
                    onClick={() => handleTemplateSelect(template.id)}
                  >
                    <div className="h-48 bg-gray-100 flex items-center justify-center">
                      <img
                        src={
                          template.thumbnail ||
                          `https://via.placeholder.com/200x280/f0fbfc/1a97a3?text=${template.name}`
                        }
                        alt={template.name}
                        className="w-full h-full object-cover"
                        onError={(e) => {
                          const target = e.target as HTMLImageElement;
                          target.src = `https://via.placeholder.com/200x280/f0fbfc/1a97a3?text=${template.name}`;
                        }}
                      />
                    </div>
                    <div className="p-2 bg-white">
                      <h3 className="text-xs font-medium">{template.name}</h3>
                    </div>
                  </div>
                ))}
              </div>
            </div>

            <div className="p-4 pt-2 text-center">
              <Button
                className="bg-resume-teal hover:bg-resume-teal-dark text-white px-6"
                onClick={handleContinue}
              >
                Use This Template <ChevronRight className="ml-1 h-4 w-4" />
              </Button>
            </div>
          </div>
        )}
      </div>
    </div>
  );
};

export default Welcome;
