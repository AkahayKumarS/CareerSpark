
import React from 'react';
import { useResume } from '../../contexts/ResumeContext';
import { Phone, Mail, MapPin, Linkedin, Globe, Github } from 'lucide-react';

const CompactTemplate = () => {
  const { resumeData, customization } = useResume();
  const { personalInfo, education, experience, skills, projects, certifications, languages, hobbies } = resumeData;
  const { font, fontSize, colorTheme, visibleSections } = customization;

  // Font size classes based on the fontSize setting
  const fontSizeClasses = {
    name: fontSize === 'small' ? 'text-xl' : fontSize === 'medium' ? 'text-2xl' : 'text-3xl',
    title: fontSize === 'small' ? 'text-base' : fontSize === 'medium' ? 'text-lg' : 'text-xl',
    sectionHeading: fontSize === 'small' ? 'text-base' : fontSize === 'medium' ? 'text-lg' : 'text-xl',
    normal: fontSize === 'small' ? 'text-xs' : fontSize === 'medium' ? 'text-sm' : 'text-base',
  };

  return (
    <div 
      className={`w-full h-full bg-white p-4 font-${font.toLowerCase()} resume-preview`}
      style={{ fontSize: fontSize === 'small' ? '13px' : fontSize === 'medium' ? '14px' : '15px' }}
    >
      {/* Compact Header with colored background */}
      <header 
        className="p-3 rounded-sm mb-4 text-white"
        style={{ backgroundColor: colorTheme }}
      >
        <div className="flex flex-wrap justify-between items-center">
          <div>
            <h1 className={`${fontSizeClasses.name} font-bold`}>
              {personalInfo.fullName}
            </h1>
            <h2 className={`${fontSizeClasses.title} font-medium opacity-90`}>
              {personalInfo.title}
            </h2>
          </div>
          <div className="text-right">
            {personalInfo.phone && (
              <div className="flex items-center justify-end text-xs mb-1">
                <span className="mr-1">{personalInfo.phone}</span>
                <Phone className="h-3 w-3" />
              </div>
            )}
            {personalInfo.email && (
              <div className="flex items-center justify-end text-xs mb-1">
                <span className="mr-1">{personalInfo.email}</span>
                <Mail className="h-3 w-3" />
              </div>
            )}
            {personalInfo.address && (
              <div className="flex items-center justify-end text-xs">
                <span className="mr-1">{personalInfo.address}</span>
                <MapPin className="h-3 w-3" />
              </div>
            )}
          </div>
        </div>

        {/* Links in a single row at the bottom */}
        {(personalInfo.linkedin || personalInfo.website || personalInfo.github) && (
          <div className="flex flex-wrap gap-4 mt-2 pt-2 border-t border-white/30 text-xs">
            {personalInfo.linkedin && (
              <div className="flex items-center">
                <Linkedin className="h-3 w-3 mr-1" />
                <span>{personalInfo.linkedin}</span>
              </div>
            )}
            {personalInfo.website && (
              <div className="flex items-center">
                <Globe className="h-3 w-3 mr-1" />
                <span>{personalInfo.website}</span>
              </div>
            )}
            {personalInfo.github && (
              <div className="flex items-center">
                <Github className="h-3 w-3 mr-1" />
                <span>{personalInfo.github}</span>
              </div>
            )}
          </div>
        )}
      </header>

      {/* Two column layout for the main content */}
      <div className="grid grid-cols-3 gap-4">
        {/* Left column: Skills, Languages, Certifications, Hobbies */}
        <div className="col-span-1 space-y-4">
          {/* Skills */}
          {visibleSections.skills && skills.length > 0 && (
            <section>
              <h3 
                className={`${fontSizeClasses.sectionHeading} font-bold pb-1 mb-2`}
                style={{ color: colorTheme, borderBottom: `1px solid ${colorTheme}` }}
              >
                Skills
              </h3>
              <div className="space-y-2">
                {skills.map((skill) => (
                  <div key={skill.id} className="mb-1">
                    <div className="flex justify-between mb-1">
                      <span className={`${fontSizeClasses.normal} font-medium`}>
                        {skill.name}
                      </span>
                      <span className={`${fontSizeClasses.normal} text-gray-600`}>
                        {skill.level}%
                      </span>
                    </div>
                    <div className="w-full bg-gray-200 rounded-full h-1.5">
                      <div 
                        className="h-1.5 rounded-full" 
                        style={{ width: `${skill.level}%`, backgroundColor: colorTheme }}
                      ></div>
                    </div>
                  </div>
                ))}
              </div>
            </section>
          )}

          {/* Languages */}
          {visibleSections.languages && languages.length > 0 && (
            <section>
              <h3 
                className={`${fontSizeClasses.sectionHeading} font-bold pb-1 mb-2`}
                style={{ color: colorTheme, borderBottom: `1px solid ${colorTheme}` }}
              >
                Languages
              </h3>
              <ul className="list-disc pl-4 space-y-0.5">
                {languages.map((lang, index) => (
                  <li key={index} className={`${fontSizeClasses.normal}`}>{lang}</li>
                ))}
              </ul>
            </section>
          )}

          {/* Certifications */}
          {visibleSections.certifications && certifications.length > 0 && (
            <section>
              <h3 
                className={`${fontSizeClasses.sectionHeading} font-bold pb-1 mb-2`}
                style={{ color: colorTheme, borderBottom: `1px solid ${colorTheme}` }}
              >
                Certifications
              </h3>
              <ul className="list-disc pl-4 space-y-0.5">
                {certifications.map((cert, index) => (
                  <li key={index} className={`${fontSizeClasses.normal}`}>{cert}</li>
                ))}
              </ul>
            </section>
          )}

          {/* Hobbies */}
          {visibleSections.hobbies && hobbies.length > 0 && (
            <section>
              <h3 
                className={`${fontSizeClasses.sectionHeading} font-bold pb-1 mb-2`}
                style={{ color: colorTheme, borderBottom: `1px solid ${colorTheme}` }}
              >
                Hobbies
              </h3>
              <div className="flex flex-wrap gap-1">
                {hobbies.map((hobby, index) => (
                  <span 
                    key={index} 
                    className={`${fontSizeClasses.normal} px-2 py-0.5 text-xs rounded`}
                    style={{ backgroundColor: `${colorTheme}20`, color: colorTheme }}
                  >
                    {hobby}
                  </span>
                ))}
              </div>
            </section>
          )}
        </div>

        {/* Right column: Experience, Education, Projects */}
        <div className="col-span-2 space-y-4">
          {/* Bio / Summary */}
          {personalInfo.bio && (
            <section className="mb-3">
              <h3 
                className={`${fontSizeClasses.sectionHeading} font-bold pb-1 mb-2`}
                style={{ color: colorTheme, borderBottom: `1px solid ${colorTheme}` }}
              >
                Professional Summary
              </h3>
              <p className={`${fontSizeClasses.normal} text-gray-700`}>
                {personalInfo.bio}
              </p>
            </section>
          )}

          {/* Experience */}
          {visibleSections.experience && experience.length > 0 && (
            <section>
              <h3 
                className={`${fontSizeClasses.sectionHeading} font-bold pb-1 mb-2`}
                style={{ color: colorTheme, borderBottom: `1px solid ${colorTheme}` }}
              >
                Experience
              </h3>
              <div className="space-y-2">
                {experience.map((exp) => (
                  <div key={exp.id} className="mb-2">
                    <div className="flex justify-between items-start">
                      <h4 className={`${fontSizeClasses.normal} font-bold`}>
                        {exp.position} | {exp.company}
                      </h4>
                      <span className={`${fontSizeClasses.normal} text-gray-600 text-xs`}>
                        {exp.startDate} - {exp.isCurrentPosition ? 'Present' : exp.endDate}
                      </span>
                    </div>
                    <p className={`${fontSizeClasses.normal} text-gray-600 mt-1`}>
                      {exp.description}
                    </p>
                  </div>
                ))}
              </div>
            </section>
          )}

          {/* Education */}
          {visibleSections.education && education.length > 0 && (
            <section>
              <h3 
                className={`${fontSizeClasses.sectionHeading} font-bold pb-1 mb-2`}
                style={{ color: colorTheme, borderBottom: `1px solid ${colorTheme}` }}
              >
                Education
              </h3>
              <div className="space-y-2">
                {education.map((edu) => (
                  <div key={edu.id} className="mb-2">
                    <div className="flex justify-between items-start">
                      <h4 className={`${fontSizeClasses.normal} font-bold`}>
                        {edu.degree} in {edu.fieldOfStudy} | {edu.institution}
                      </h4>
                      <span className={`${fontSizeClasses.normal} text-gray-600 text-xs`}>
                        {edu.startDate} - {edu.endDate}
                      </span>
                    </div>
                    {edu.description && (
                      <p className={`${fontSizeClasses.normal} text-gray-600 mt-1`}>
                        {edu.description}
                      </p>
                    )}
                  </div>
                ))}
              </div>
            </section>
          )}

          {/* Projects */}
          {visibleSections.projects && projects.length > 0 && (
            <section>
              <h3 
                className={`${fontSizeClasses.sectionHeading} font-bold pb-1 mb-2`}
                style={{ color: colorTheme, borderBottom: `1px solid ${colorTheme}` }}
              >
                Projects
              </h3>
              <div className="space-y-2">
                {projects.map((project) => (
                  <div key={project.id} className="mb-2">
                    <div className="flex justify-between items-start">
                      <h4 className={`${fontSizeClasses.normal} font-bold`}>
                        {project.title}
                      </h4>
                      {project.link && (
                        <a 
                          href={project.link} 
                          target="_blank" 
                          rel="noopener noreferrer"
                          className="text-xs underline"
                          style={{ color: colorTheme }}
                        >
                          Link
                        </a>
                      )}
                    </div>
                    <p className={`${fontSizeClasses.normal} mt-0.5 text-gray-700`}>
                      {project.description}
                    </p>
                    <p className={`${fontSizeClasses.normal} text-gray-600 text-xs mt-0.5`}>
                      <strong>Tech:</strong> {project.technologies}
                    </p>
                  </div>
                ))}
              </div>
            </section>
          )}
        </div>
      </div>
    </div>
  );
};

export default CompactTemplate;
