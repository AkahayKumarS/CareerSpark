import React, { useState } from "react";
import { ResumeProvider } from "../contexts/ResumeContext";
import TemplateSidebar from "../components/TemplateSidebar";
import CustomizationPanel from "../components/CustomizationPanel";
import TemplateSelector from "../components/TemplateSelector";
import Welcome from "../components/Welcome";
import { Button } from "@/components/ui/button";
import { Edit } from "lucide-react";
import PDFDownloader from "../components/PDFDownloader";

const Index = () => {
  const [isTemplateSidebarOpen, setIsTemplateSidebarOpen] = useState(false);
  const [isCustomizationPanelOpen, setIsCustomizationPanelOpen] =
    useState(false);
  const [started, setStarted] = useState(false);

  const toggleTemplateSidebar = () => {
    setIsTemplateSidebarOpen(!isTemplateSidebarOpen);
  };

  const toggleCustomizationPanel = () => {
    setIsCustomizationPanelOpen(!isCustomizationPanelOpen);
  };

  const handleStart = () => {
    setStarted(true);
  };

  return (
    <ResumeProvider>
      <div className={`bg-gray-100 p-0 m-0 ${started && "mt-3"}`}>
        {!started ? (
          <Welcome onStart={handleStart} />
        ) : (
          <>
            <header className="bg-white shadow-sm p-1 m-0 pr-14">
              <div className="flex justify-between items-center w-full">
                <h1 className="text-2xl font-bold text-resume-teal-dark ml-16">
                  CareerSpark Resume Builder
                </h1>
                <div className="flex gap-1 mr-2">
                  <Button
                    variant="outline"
                    size="sm"
                    onClick={toggleTemplateSidebar}
                    className="flex items-center text-xs px-2"
                  >
                    Change Template
                  </Button>

                  <Button
                    variant="outline"
                    size="sm"
                    onClick={toggleCustomizationPanel}
                    className="flex items-center text-xs px-2"
                  >
                    <Edit className="h-3 w-3 mr-1" />
                    Customize
                  </Button>

                  <PDFDownloader />
                </div>
              </div>
            </header>

            <main className="w-full p-0 m-0">
              <div className="bg-white rounded-none shadow-none p-0 m-0 w-full">
                <div
                  className="overflow-auto"
                  style={{ maxHeight: "calc(100vh - 60px)" }}
                >
                  <TemplateSelector />
                </div>
              </div>
            </main>

            <TemplateSidebar
              isOpen={isTemplateSidebarOpen}
              onToggle={toggleTemplateSidebar}
            />

            <CustomizationPanel
              isOpen={isCustomizationPanelOpen}
              onToggle={toggleCustomizationPanel}
            />
          </>
        )}
      </div>
    </ResumeProvider>
  );
};

export default Index;
