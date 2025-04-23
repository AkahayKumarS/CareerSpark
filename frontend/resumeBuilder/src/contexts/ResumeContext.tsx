
import React, { createContext, useContext, useState, useEffect } from "react";
import { templates } from "../data/templates";

// Define the types
export type Education = {
  id: string;
  institution: string;
  degree: string;
  fieldOfStudy: string;
  startDate: string;
  endDate: string;
  description: string;
};

export type Experience = {
  id: string;
  company: string;
  position: string;
  startDate: string;
  endDate: string;
  description: string;
  isCurrentPosition?: boolean;
};

export type Skill = {
  id: string;
  name: string;
  level: number;
};

export type Project = {
  id: string;
  title: string;
  description: string;
  technologies: string;
  link?: string;
};

export type PersonalInfo = {
  fullName: string;
  title: string;
  email: string;
  phone: string;
  address: string;
  linkedin?: string;
  github?: string;
  website?: string;
  bio: string;
  profileImage?: string | null;
};

export type ResumeData = {
  personalInfo: PersonalInfo;
  education: Education[];
  experience: Experience[];
  skills: Skill[];
  projects: Project[];
  certifications: string[];
  languages: string[];
  hobbies: string[];
};

export type Template = {
  id: string;
  name: string;
  thumbnail: string;
  fonts: string[];
  colors: string[];
};

export type CustomizationOptions = {
  activeTemplateId: string;
  font: string;
  fontSize: string;
  colorTheme: string;
  visibleSections: {
    education: boolean;
    experience: boolean;
    skills: boolean;
    projects: boolean;
    certifications: boolean;
    languages: boolean;
    hobbies: boolean;
  };
};

type ResumeContextType = {
  resumeData: ResumeData;
  setResumeData: React.Dispatch<React.SetStateAction<ResumeData>>;
  customization: CustomizationOptions;
  setCustomization: React.Dispatch<React.SetStateAction<CustomizationOptions>>;
  templates: Template[];
  activeTemplate: Template;
  changeTemplate: (templateId: string) => void;
  updatePersonalInfo: (info: Partial<PersonalInfo>) => void;
  addEducation: (education: Omit<Education, "id">) => void;
  updateEducation: (id: string, education: Partial<Education>) => void;
  removeEducation: (id: string) => void;
  addExperience: (experience: Omit<Experience, "id">) => void;
  updateExperience: (id: string, experience: Partial<Experience>) => void;
  removeExperience: (id: string) => void;
  addSkill: (skill: Omit<Skill, "id">) => void;
  updateSkill: (id: string, skill: Partial<Skill>) => void;
  removeSkill: (id: string) => void;
  addProject: (project: Omit<Project, "id">) => void;
  updateProject: (id: string, project: Partial<Project>) => void;
  removeProject: (id: string) => void;
  uploadResumeData: (data: Partial<ResumeData>) => void;
  resetToTemplate: () => void;
  setSectionVisibility: (section: keyof CustomizationOptions["visibleSections"], isVisible: boolean) => void;
  setFont: (font: string) => void;
  setFontSize: (size: string) => void;
  setColorTheme: (color: string) => void;
};

// Create dummy data for initial state
const initialResumeData: ResumeData = {
  personalInfo: {
    fullName: "Ravi Kumar",
    title: "Senior Software Engineer",
    email: "ravi.kumar@example.com",
    phone: "+91 9876543210",
    address: "Bangalore, Karnataka, India",
    linkedin: "linkedin.com/in/ravikumar",
    github: "github.com/ravikumar",
    website: "ravikumar.dev",
    bio: "Experienced software engineer with expertise in full-stack development, cloud computing, and agile methodologies. Passionate about building scalable solutions and mentoring junior developers."
  },
  education: [
    {
      id: "ed1",
      institution: "Indian Institute of Technology, Delhi",
      degree: "B.Tech",
      fieldOfStudy: "Computer Science",
      startDate: "2014-07",
      endDate: "2018-05",
      description: "Graduated with distinction. Relevant coursework: Data Structures, Algorithms, Database Management Systems, Software Engineering"
    },
    {
      id: "ed2",
      institution: "Indian Institute of Management, Bangalore",
      degree: "MBA",
      fieldOfStudy: "Technology Management",
      startDate: "2020-07",
      endDate: "2022-05",
      description: "Specialized in Technology Management and Product Development"
    }
  ],
  experience: [
    {
      id: "exp1",
      company: "Infosys",
      position: "Senior Software Engineer",
      startDate: "2022-06",
      endDate: "",
      isCurrentPosition: true,
      description: "Leading a team of 5 developers working on cloud-native applications. Implemented CI/CD pipelines reducing deployment time by 40%. Architected and built scalable microservices using Spring Boot and Docker."
    },
    {
      id: "exp2",
      company: "Wipro",
      position: "Software Engineer",
      startDate: "2018-06",
      endDate: "2022-05",
      description: "Developed and maintained RESTful APIs for e-commerce platforms. Collaborated with cross-functional teams to deliver high-quality software solutions. Mentored junior developers and conducted code reviews."
    },
    {
      id: "exp3",
      company: "TCS",
      position: "Software Developer Intern",
      startDate: "2017-12",
      endDate: "2018-05",
      description: "Built and optimized database queries. Assisted in front-end development using React.js. Participated in daily scrum meetings and sprint planning."
    }
  ],
  skills: [
    { id: "sk1", name: "JavaScript", level: 90 },
    { id: "sk2", name: "React.js", level: 85 },
    { id: "sk3", name: "Node.js", level: 80 },
    { id: "sk4", name: "Java", level: 85 },
    { id: "sk5", name: "Spring Boot", level: 75 },
    { id: "sk6", name: "Docker", level: 70 },
    { id: "sk7", name: "Kubernetes", level: 65 },
    { id: "sk8", name: "SQL", level: 85 },
    { id: "sk9", name: "MongoDB", level: 75 }
  ],
  projects: [
    {
      id: "pr1",
      title: "E-commerce Platform",
      description: "Built a full-stack e-commerce platform with payment integration, user authentication, and inventory management.",
      technologies: "React.js, Node.js, Express, MongoDB, Stripe API",
      link: "github.com/ravikumar/ecommerce"
    },
    {
      id: "pr2",
      title: "Health Monitoring System",
      description: "Developed an IoT-based health monitoring system that tracks vital signs and sends alerts in emergency situations.",
      technologies: "Java, Spring Boot, MQTT, RaspberryPi, AWS IoT",
      link: "github.com/ravikumar/health-monitor"
    }
  ],
  certifications: [
    "AWS Certified Solutions Architect",
    "Oracle Certified Java Professional",
    "Microsoft Certified: Azure Developer Associate"
  ],
  languages: [
    "English (Professional)",
    "Hindi (Native)",
    "Kannada (Conversational)"
  ],
  hobbies: [
    "Cricket",
    "Chess",
    "Reading",
    "Travel"
  ]
};

const initialCustomization: CustomizationOptions = {
  activeTemplateId: "template1",
  font: "Poppins",
  fontSize: "medium",
  colorTheme: "#2bc5d4",
  visibleSections: {
    education: true,
    experience: true,
    skills: true,
    projects: true,
    certifications: true,
    languages: true,
    hobbies: true
  }
};

// Generate a unique ID
const generateId = () => `_${Math.random().toString(36).substr(2, 9)}`;

// Create the context
const ResumeContext = createContext<ResumeContextType | undefined>(undefined);

export const ResumeProvider: React.FC<{ children: React.ReactNode }> = ({ children }) => {
  const [resumeData, setResumeData] = useState<ResumeData>(initialResumeData);
  const [customization, setCustomization] = useState<CustomizationOptions>(initialCustomization);

  // Find the active template based on the customization options
  const activeTemplate = templates.find(template => template.id === customization.activeTemplateId) || templates[0];

  // Change the template
  const changeTemplate = (templateId: string) => {
    setCustomization(prev => ({
      ...prev,
      activeTemplateId: templateId
    }));
  };

  // Update personal information
  const updatePersonalInfo = (info: Partial<PersonalInfo>) => {
    setResumeData(prev => ({
      ...prev,
      personalInfo: {
        ...prev.personalInfo,
        ...info
      }
    }));
  };

  // Education functions
  const addEducation = (education: Omit<Education, "id">) => {
    const newEducation = { ...education, id: generateId() };
    setResumeData(prev => ({
      ...prev,
      education: [...prev.education, newEducation]
    }));
  };

  const updateEducation = (id: string, education: Partial<Education>) => {
    setResumeData(prev => ({
      ...prev,
      education: prev.education.map(item => 
        item.id === id ? { ...item, ...education } : item
      )
    }));
  };

  const removeEducation = (id: string) => {
    setResumeData(prev => ({
      ...prev,
      education: prev.education.filter(item => item.id !== id)
    }));
  };

  // Experience functions
  const addExperience = (experience: Omit<Experience, "id">) => {
    const newExperience = { ...experience, id: generateId() };
    setResumeData(prev => ({
      ...prev,
      experience: [...prev.experience, newExperience]
    }));
  };

  const updateExperience = (id: string, experience: Partial<Experience>) => {
    setResumeData(prev => ({
      ...prev,
      experience: prev.experience.map(item => 
        item.id === id ? { ...item, ...experience } : item
      )
    }));
  };

  const removeExperience = (id: string) => {
    setResumeData(prev => ({
      ...prev,
      experience: prev.experience.filter(item => item.id !== id)
    }));
  };

  // Skills functions
  const addSkill = (skill: Omit<Skill, "id">) => {
    const newSkill = { ...skill, id: generateId() };
    setResumeData(prev => ({
      ...prev,
      skills: [...prev.skills, newSkill]
    }));
  };

  const updateSkill = (id: string, skill: Partial<Skill>) => {
    setResumeData(prev => ({
      ...prev,
      skills: prev.skills.map(item => 
        item.id === id ? { ...item, ...skill } : item
      )
    }));
  };

  const removeSkill = (id: string) => {
    setResumeData(prev => ({
      ...prev,
      skills: prev.skills.filter(item => item.id !== id)
    }));
  };

  // Project functions
  const addProject = (project: Omit<Project, "id">) => {
    const newProject = { ...project, id: generateId() };
    setResumeData(prev => ({
      ...prev,
      projects: [...prev.projects, newProject]
    }));
  };

  const updateProject = (id: string, project: Partial<Project>) => {
    setResumeData(prev => ({
      ...prev,
      projects: prev.projects.map(item => 
        item.id === id ? { ...item, ...project } : item
      )
    }));
  };

  const removeProject = (id: string) => {
    setResumeData(prev => ({
      ...prev,
      projects: prev.projects.filter(item => item.id !== id)
    }));
  };

  // Upload resume data function
  const uploadResumeData = (data: Partial<ResumeData>) => {
    setResumeData(prev => ({
      ...prev,
      ...data
    }));
  };

  // Reset to template data
  const resetToTemplate = () => {
    setResumeData(initialResumeData);
  };

  // Set section visibility
  const setSectionVisibility = (section: keyof CustomizationOptions["visibleSections"], isVisible: boolean) => {
    setCustomization(prev => ({
      ...prev,
      visibleSections: {
        ...prev.visibleSections,
        [section]: isVisible
      }
    }));
  };

  // Set font
  const setFont = (font: string) => {
    setCustomization(prev => ({
      ...prev,
      font
    }));
  };

  // Set font size
  const setFontSize = (fontSize: string) => {
    setCustomization(prev => ({
      ...prev,
      fontSize
    }));
  };

  // Set color theme
  const setColorTheme = (colorTheme: string) => {
    setCustomization(prev => ({
      ...prev,
      colorTheme
    }));
  };

  const value = {
    resumeData,
    setResumeData,
    customization,
    setCustomization,
    templates,
    activeTemplate,
    changeTemplate,
    updatePersonalInfo,
    addEducation,
    updateEducation,
    removeEducation,
    addExperience,
    updateExperience,
    removeExperience,
    addSkill,
    updateSkill,
    removeSkill,
    addProject,
    updateProject,
    removeProject,
    uploadResumeData,
    resetToTemplate,
    setSectionVisibility,
    setFont,
    setFontSize,
    setColorTheme
  };

  return (
    <ResumeContext.Provider value={value}>
      {children}
    </ResumeContext.Provider>
  );
};

export const useResume = (): ResumeContextType => {
  const context = useContext(ResumeContext);
  if (context === undefined) {
    throw new Error('useResume must be used within a ResumeProvider');
  }
  return context;
};
