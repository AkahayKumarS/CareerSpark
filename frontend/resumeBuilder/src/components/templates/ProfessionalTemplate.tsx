import React from "react";
import { useResume, ResumeData } from "../../contexts/ResumeContext";
import { Phone, Mail, MapPin, Linkedin, Globe, Github } from "lucide-react";

const ProfessionalTemplate = () => {
  const { resumeData, customization } = useResume();
  const {
    personalInfo,
    education,
    experience,
    skills,
    projects,
    certifications,
    languages,
    hobbies,
  } = resumeData;
  const { font, fontSize, colorTheme, visibleSections } = customization;

  // Font size classes based on the fontSize setting
  const fontSizeClasses = {
    name:
      fontSize === "small"
        ? "text-2xl"
        : fontSize === "medium"
        ? "text-3xl"
        : "text-4xl",
    title:
      fontSize === "small"
        ? "text-lg"
        : fontSize === "medium"
        ? "text-xl"
        : "text-2xl",
    sectionHeading:
      fontSize === "small"
        ? "text-lg"
        : fontSize === "medium"
        ? "text-xl"
        : "text-2xl",
    normal:
      fontSize === "small"
        ? "text-xs"
        : fontSize === "medium"
        ? "text-sm"
        : "text-base",
  };

  return (
    <div
      className={`w-full h-full bg-white p-6 font-${font.toLowerCase()} resume-preview`}
      style={{
        fontSize:
          fontSize === "small"
            ? "14px"
            : fontSize === "medium"
            ? "16px"
            : "18px",
      }}
    >
      {/* Header */}
      <header className="mb-6">
        <h1
          className={`${fontSizeClasses.name} font-bold`}
          style={{ color: colorTheme }}
        >
          {personalInfo.fullName}
        </h1>
        <h2
          className={`${fontSizeClasses.title} font-medium text-gray-700 mb-3`}
        >
          {personalInfo.title}
        </h2>

        {/* Contact Information */}
        <div className="flex flex-wrap gap-3 text-sm">
          {personalInfo.phone && (
            <div className="flex items-center">
              <Phone className="h-4 w-4 mr-1" style={{ color: colorTheme }} />
              <span>{personalInfo.phone}</span>
            </div>
          )}
          {personalInfo.email && (
            <div className="flex items-center">
              <Mail className="h-4 w-4 mr-1" style={{ color: colorTheme }} />
              <span>{personalInfo.email}</span>
            </div>
          )}
          {personalInfo.address && (
            <div className="flex items-center">
              <MapPin className="h-4 w-4 mr-1" style={{ color: colorTheme }} />
              <span>{personalInfo.address}</span>
            </div>
          )}
          {personalInfo.linkedin && (
            <div className="flex items-center">
              <Linkedin
                className="h-4 w-4 mr-1"
                style={{ color: colorTheme }}
              />
              <span>{personalInfo.linkedin}</span>
            </div>
          )}
          {personalInfo.website && (
            <div className="flex items-center">
              <Globe className="h-4 w-4 mr-1" style={{ color: colorTheme }} />
              <span>{personalInfo.website}</span>
            </div>
          )}
          {personalInfo.github && (
            <div className="flex items-center">
              <Github className="h-4 w-4 mr-1" style={{ color: colorTheme }} />
              <span>{personalInfo.github}</span>
            </div>
          )}
        </div>
      </header>

      {personalInfo.bio && (
        <section className="mb-6">
          <p className={`${fontSizeClasses.normal} text-gray-700`}>
            {personalInfo.bio}
          </p>
        </section>
      )}

      <div className="grid grid-cols-3 gap-6">
        <div className="col-span-2 space-y-6">
          {/* Experience */}
          {visibleSections.experience && experience.length > 0 && (
            <section>
              <h2
                className={`${fontSizeClasses.sectionHeading} font-bold mb-3 pb-1 border-b-2`}
                style={{ borderColor: colorTheme, color: colorTheme }}
              >
                Experience
              </h2>
              <div className="space-y-4">
                {experience.map((exp) => (
                  <div key={exp.id}>
                    <div className="flex justify-between items-start">
                      <h3 className={`${fontSizeClasses.normal} font-bold`}>
                        {exp.position}
                      </h3>
                      <span
                        className={`${fontSizeClasses.normal} text-gray-600`}
                      >
                        {exp.startDate} -{" "}
                        {exp.isCurrentPosition ? "Present" : exp.endDate}
                      </span>
                    </div>
                    <h4
                      className={`${fontSizeClasses.normal} font-medium text-gray-700`}
                    >
                      {exp.company}
                    </h4>
                    <p
                      className={`${fontSizeClasses.normal} text-gray-600 mt-1`}
                    >
                      {exp.description}
                    </p>
                  </div>
                ))}
              </div>
            </section>
          )}

          {/* Projects */}
          {visibleSections.projects && projects.length > 0 && (
            <section>
              <h2
                className={`${fontSizeClasses.sectionHeading} font-bold mb-3 pb-1 border-b-2`}
                style={{ borderColor: colorTheme, color: colorTheme }}
              >
                Projects
              </h2>
              <div className="space-y-4">
                {projects.map((project) => (
                  <div key={project.id}>
                    <h3 className={`${fontSizeClasses.normal} font-bold`}>
                      {project.title}
                      {project.link && (
                        <a
                          href={project.link}
                          target="_blank"
                          rel="noopener noreferrer"
                          className="text-sm text-blue-500 ml-2"
                          style={{ color: colorTheme }}
                        >
                          Link
                        </a>
                      )}
                    </h3>
                    <p className={`${fontSizeClasses.normal} mt-1`}>
                      {project.description}
                    </p>
                    <p
                      className={`${fontSizeClasses.normal} text-gray-600 mt-1`}
                    >
                      <strong>Technologies:</strong> {project.technologies}
                    </p>
                  </div>
                ))}
              </div>
            </section>
          )}

          {/* Education */}
          {visibleSections.education && education.length > 0 && (
            <section>
              <h2
                className={`${fontSizeClasses.sectionHeading} font-bold mb-3 pb-1 border-b-2`}
                style={{ borderColor: colorTheme, color: colorTheme }}
              >
                Education
              </h2>
              <div className="space-y-4">
                {education.map((edu) => (
                  <div key={edu.id}>
                    <div className="flex justify-between items-start">
                      <h3 className={`${fontSizeClasses.normal} font-bold`}>
                        {edu.degree} in {edu.fieldOfStudy}
                      </h3>
                      <span
                        className={`${fontSizeClasses.normal} text-gray-600`}
                      >
                        {edu.startDate} - {edu.endDate}
                      </span>
                    </div>
                    <h4
                      className={`${fontSizeClasses.normal} font-medium text-gray-700`}
                    >
                      {edu.institution}
                    </h4>
                    {edu.description && (
                      <p
                        className={`${fontSizeClasses.normal} text-gray-600 mt-1`}
                      >
                        {edu.description}
                      </p>
                    )}
                  </div>
                ))}
              </div>
            </section>
          )}
        </div>

        <div className="space-y-6">
          {/* Skills */}
          {visibleSections.skills && skills.length > 0 && (
            <section>
              <h2
                className={`${fontSizeClasses.sectionHeading} font-bold mb-3 pb-1 border-b-2`}
                style={{ borderColor: colorTheme, color: colorTheme }}
              >
                Skills
              </h2>
              <div className="space-y-2">
                {skills.map((skill) => (
                  <div key={skill.id} className="mb-2">
                    <div className="flex justify-between mb-1">
                      <span className={`${fontSizeClasses.normal} font-medium`}>
                        {skill.name}
                      </span>
                      <span
                        className={`${fontSizeClasses.normal} text-gray-600`}
                      >
                        {skill.level}%
                      </span>
                    </div>
                    <div className="w-full bg-gray-200 rounded-full h-2">
                      <div
                        className="h-2 rounded-full"
                        style={{
                          width: `${skill.level}%`,
                          backgroundColor: colorTheme,
                        }}
                      ></div>
                    </div>
                  </div>
                ))}
              </div>
            </section>
          )}

          {/* Certifications */}
          {visibleSections.certifications && certifications.length > 0 && (
            <section>
              <h2
                className={`${fontSizeClasses.sectionHeading} font-bold mb-3 pb-1 border-b-2`}
                style={{ borderColor: colorTheme, color: colorTheme }}
              >
                Certifications
              </h2>
              <ul className="list-disc pl-5 space-y-1">
                {certifications.map((cert, index) => (
                  <li key={index} className={`${fontSizeClasses.normal}`}>
                    {cert}
                  </li>
                ))}
              </ul>
            </section>
          )}

          {/* Languages */}
          {visibleSections.languages && languages.length > 0 && (
            <section>
              <h2
                className={`${fontSizeClasses.sectionHeading} font-bold mb-3 pb-1 border-b-2`}
                style={{ borderColor: colorTheme, color: colorTheme }}
              >
                Languages
              </h2>
              <ul className="list-disc pl-5 space-y-1">
                {languages.map((lang, index) => (
                  <li key={index} className={`${fontSizeClasses.normal}`}>
                    {lang}
                  </li>
                ))}
              </ul>
            </section>
          )}

          {/* Hobbies */}
          {visibleSections.hobbies && hobbies.length > 0 && (
            <section>
              <h2
                className={`${fontSizeClasses.sectionHeading} font-bold mb-3 pb-1 border-b-2`}
                style={{ borderColor: colorTheme, color: colorTheme }}
              >
                Hobbies
              </h2>
              <div className="flex flex-wrap gap-2">
                {hobbies.map((hobby, index) => (
                  <span
                    key={index}
                    className={`${fontSizeClasses.normal} px-3 py-1 rounded-full`}
                    style={{
                      backgroundColor: `${colorTheme}20`,
                      color: colorTheme,
                    }}
                  >
                    {hobby}
                  </span>
                ))}
              </div>
            </section>
          )}
        </div>
      </div>
    </div>
  );
};

export default ProfessionalTemplate;
