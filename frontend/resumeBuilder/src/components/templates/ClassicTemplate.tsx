
import React from 'react';
import { useResume } from '../../contexts/ResumeContext';
import { Phone, Mail, MapPin, Linkedin, Globe, Github } from 'lucide-react';

const ClassicTemplate = () => {
  const { resumeData, customization } = useResume();
  const { personalInfo, education, experience, skills, projects, certifications, languages, hobbies } = resumeData;
  const { font, fontSize, colorTheme, visibleSections } = customization;

  // Font size classes based on the fontSize setting
  const fontSizeClasses = {
    name: fontSize === 'small' ? 'text-2xl' : fontSize === 'medium' ? 'text-3xl' : 'text-4xl',
    title: fontSize === 'small' ? 'text-lg' : fontSize === 'medium' ? 'text-xl' : 'text-2xl',
    sectionHeading: fontSize === 'small' ? 'text-lg' : fontSize === 'medium' ? 'text-xl' : 'text-2xl',
    normal: fontSize === 'small' ? 'text-xs' : fontSize === 'medium' ? 'text-sm' : 'text-base',
  };

  return (
    <div 
      className={`w-full h-full bg-white p-8 font-${font.toLowerCase()} resume-preview`}
      style={{ fontSize: fontSize === 'small' ? '14px' : fontSize === 'medium' ? '16px' : '18px' }}
    >
      {/* Header with centered content */}
      <header className="text-center mb-6 pb-4 border-b-2" style={{ borderColor: colorTheme }}>
        <h1 className={`${fontSizeClasses.name} font-bold mb-1`} style={{ color: colorTheme }}>
          {personalInfo.fullName}
        </h1>
        <h2 className={`${fontSizeClasses.title} font-medium text-gray-700 mb-3`}>
          {personalInfo.title}
        </h2>
        
        {/* Contact Information in centered row */}
        <div className="flex flex-wrap justify-center gap-4 text-sm">
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
              <Linkedin className="h-4 w-4 mr-1" style={{ color: colorTheme }} />
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

      {/* Main content */}
      <div className="space-y-6">
        {/* Experience */}
        {visibleSections.experience && experience.length > 0 && (
          <section>
            <h2 
              className={`${fontSizeClasses.sectionHeading} font-bold mb-3 pb-1 text-center`}
              style={{ color: colorTheme }}
            >
              EXPERIENCE
            </h2>
            <div className="space-y-4">
              {experience.map((exp) => (
                <div key={exp.id} className="mb-3 pb-3 border-b border-gray-200 last:border-0">
                  <div className="flex justify-between items-start">
                    <h3 className={`${fontSizeClasses.normal} font-bold`}>
                      {exp.position}
                    </h3>
                    <span className={`${fontSizeClasses.normal} text-gray-600`}>
                      {exp.startDate} - {exp.isCurrentPosition ? 'Present' : exp.endDate}
                    </span>
                  </div>
                  <h4 className={`${fontSizeClasses.normal} font-medium text-gray-700`}>
                    {exp.company}
                  </h4>
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
            <h2 
              className={`${fontSizeClasses.sectionHeading} font-bold mb-3 pb-1 text-center`}
              style={{ color: colorTheme }}
            >
              EDUCATION
            </h2>
            <div className="space-y-4">
              {education.map((edu) => (
                <div key={edu.id} className="mb-3 pb-3 border-b border-gray-200 last:border-0">
                  <div className="flex justify-between items-start">
                    <h3 className={`${fontSizeClasses.normal} font-bold`}>
                      {edu.degree} in {edu.fieldOfStudy}
                    </h3>
                    <span className={`${fontSizeClasses.normal} text-gray-600`}>
                      {edu.startDate} - {edu.endDate}
                    </span>
                  </div>
                  <h4 className={`${fontSizeClasses.normal} font-medium text-gray-700`}>
                    {edu.institution}
                  </h4>
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
            <h2 
              className={`${fontSizeClasses.sectionHeading} font-bold mb-3 pb-1 text-center`}
              style={{ color: colorTheme }}
            >
              PROJECTS
            </h2>
            <div className="space-y-4">
              {projects.map((project) => (
                <div key={project.id} className="mb-3 pb-3 border-b border-gray-200 last:border-0">
                  <div className="flex justify-between items-start">
                    <h3 className={`${fontSizeClasses.normal} font-bold`}>
                      {project.title}
                    </h3>
                    {project.link && (
                      <a 
                        href={project.link} 
                        target="_blank" 
                        rel="noopener noreferrer"
                        className="text-sm underline"
                        style={{ color: colorTheme }}
                      >
                        View Project
                      </a>
                    )}
                  </div>
                  <p className={`${fontSizeClasses.normal} mt-1`}>
                    {project.description}
                  </p>
                  <p className={`${fontSizeClasses.normal} text-gray-600 mt-1`}>
                    <strong>Technologies:</strong> {project.technologies}
                  </p>
                </div>
              ))}
            </div>
          </section>
        )}

        {/* Skills, Certifications, Languages, Hobbies in a grid */}
        <div className="grid grid-cols-2 gap-6">
          {/* Skills */}
          {visibleSections.skills && skills.length > 0 && (
            <section>
              <h2 
                className={`${fontSizeClasses.sectionHeading} font-bold mb-3 pb-1 text-center`}
                style={{ color: colorTheme }}
              >
                SKILLS
              </h2>
              <div className="space-y-2">
                {skills.map((skill) => (
                  <div key={skill.id} className="mb-2">
                    <div className="flex justify-between mb-1">
                      <span className={`${fontSizeClasses.normal} font-medium`}>
                        {skill.name}
                      </span>
                      <span className={`${fontSizeClasses.normal} text-gray-600`}>
                        {skill.level}%
                      </span>
                    </div>
                    <div className="w-full bg-gray-200 rounded-full h-2">
                      <div 
                        className="h-2 rounded-full" 
                        style={{ 
                          width: `${skill.level}%`,
                          backgroundColor: colorTheme
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
                className={`${fontSizeClasses.sectionHeading} font-bold mb-3 pb-1 text-center`}
                style={{ color: colorTheme }}
              >
                CERTIFICATIONS
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
                className={`${fontSizeClasses.sectionHeading} font-bold mb-3 pb-1 text-center`}
                style={{ color: colorTheme }}
              >
                LANGUAGES
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
                className={`${fontSizeClasses.sectionHeading} font-bold mb-3 pb-1 text-center`}
                style={{ color: colorTheme }}
              >
                HOBBIES
              </h2>
              <div className="flex flex-wrap gap-2">
                {hobbies.map((hobby, index) => (
                  <span 
                    key={index} 
                    className={`${fontSizeClasses.normal} px-3 py-1 rounded-full`}
                    style={{ 
                      backgroundColor: `${colorTheme}20`, 
                      color: colorTheme 
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

export default ClassicTemplate;
