import React from "react";
import { useResume } from "../contexts/ResumeContext";
import ProfessionalTemplate from "./templates/ProfessionalTemplate";
import ModernTemplate from "./templates/ModernTemplate";
import ClassicTemplate from "./templates/ClassicTemplate";
import CompactTemplate from "./templates/CompactTemplate";
import CreativeTemplate from "./templates/CreativeTemplate";
import MinimalTemplate from "./templates/MinimalTemplate";
import ExecutiveTemplate from "./templates/ExecutiveTemplate";
import TechTemplate from "./templates/TechTemplate";
import ElegantTemplate from "./templates/ElegantTemplate";
import CorporateTemplate from "./templates/CorporateTemplate";

// This component will select the appropriate template based on the active template ID
const TemplateSelector = () => {
  const { customization } = useResume();
  const { activeTemplateId } = customization;

  // Apply A4 size styling to the container with proper scaling
  const containerStyle = {
    width: "210mm", // A4 width
    minHeight: "297mm", // A4 height as minimum
    margin: "0 auto",
    backgroundColor: "white",
    boxShadow: "0 0 10px rgba(0, 0, 0, 0.1)",
    transform: "scale(1)", // No scaling by default
    transformOrigin: "top center",
  };

  // Switch to the appropriate template component based on the active template ID
  const renderTemplate = () => {
    switch (activeTemplateId) {
      case "template1":
        return <ProfessionalTemplate />;
      case "template2":
        return <ModernTemplate />;
      case "template3":
        return <ClassicTemplate />;
      case "template4":
        return <CreativeTemplate />;
      case "template5":
        return <MinimalTemplate />;
      case "template6":
        return <ExecutiveTemplate />;
      case "template7":
        return <TechTemplate />;
      case "template8":
        return <ElegantTemplate />;
      case "template9":
        return <CorporateTemplate />;
      case "template10":
        return <CompactTemplate />;
      default:
        return <ProfessionalTemplate />;
    }
  };

  return (
    <div className="resume-page-container flex justify-center items-start p-4 overflow-auto mt-8 mb-10">
      <div className="resume-preview" style={containerStyle}>
        {renderTemplate()}
      </div>
    </div>
  );
};

export default TemplateSelector;
