
import React from 'react';
import { useResume } from '../../contexts/ResumeContext';
import { Phone, Mail, MapPin, Linkedin, Globe, Github } from 'lucide-react';

const ExecutiveTemplate = () => {
  const { resumeData, customization } = useResume();
  const { personalInfo, education, experience, skills, projects, certifications, languages, hobbies } = resumeData;
  const { font, fontSize, colorTheme, visibleSections } = customization;

  // Font size classes based on the fontSize setting
  const fontSizeClasses = {
    name: fontSize === 'small' ? 'text-3xl' : fontSize === 'medium' ? 'text-4xl' : 'text-5xl',
    title: fontSize === 'small' ? 'text-lg' : fontSize === 'medium' ? 'text-xl' : 'text-2xl',
    sectionHeading: fontSize === 'small' ? 'text-lg' : fontSize === 'medium' ? 'text-xl' : 'text-2xl',
    normal: fontSize === 'small' ? 'text-xs' : fontSize === 'medium' ? 'text-sm' : 'text-base',
  };

  return (
    <div 
      className={`w-full h-full bg-white font-${font.toLowerCase().replace(/\s+/g, '-')} resume-preview`}
      style={{ fontSize: fontSize === 'small' ? '14px' : fontSize === 'medium' ? '16px' : '18px' }}
    >
      {/* Executive header with horizontal line accent */}
      <div className="relative">
        {/* Colored top accent bar */}
        <div 
          className="h-12 w-full absolute top-0 left-0" 
          style={{ backgroundColor: colorTheme }}
        ></div>
        
        <header className="pt-16 px-8 pb-6">
          <h1 className={`${fontSizeClasses.name} font-bold mb-1`} style={{ color: '#2c3e50' }}>
            {personalInfo.fullName}
          </h1>
          <h2 className={`${fontSizeClasses.title} font-semibold mb-4`} style={{ color: colorTheme }}>
            {personalInfo.title}
          </h2>
          
          <div className="grid grid-cols-3 gap-4 text-sm">
            <div>
              {personalInfo.phone && (
                <div className="flex items-center mb-1">
                  <Phone className="h-4 w-4 mr-2" style={{ color: colorTheme }} />
                  <span className={`${fontSizeClasses.normal}`}>{personalInfo.phone}</span>
                </div>
              )}
              {personalInfo.email && (
                <div className="flex items-center">
                  <Mail className="h-4 w-4 mr-2" style={{ color: colorTheme }} />
                  <span className={`${fontSizeClasses.normal}`}>{personalInfo.email}</span>
                </div>
              )}
            </div>
            
            <div>
              {personalInfo.address && (
                <div className="flex items-center mb-1">
                  <MapPin className="h-4 w-4 mr-2" style={{ color: colorTheme }} />
                  <span className={`${fontSizeClasses.normal}`}>{personalInfo.address}</span>
                </div>
              )}
              {personalInfo.linkedin && (
                <div className="flex items-center">
                  <Linkedin className="h-4 w-4 mr-2" style={{ color: colorTheme }} />
                  <span className={`${fontSizeClasses.normal}`}>{personalInfo.linkedin}</span>
                </div>
              )}
            </div>
            
            <div>
              {personalInfo.website && (
                <div className="flex items-center mb-1">
                  <Globe className="h-4 w-4 mr-2" style={{ color: colorTheme }} />
                  <span className={`${fontSizeClasses.normal}`}>{personalInfo.website}</span>
                </div>
              )}
              {personalInfo.github && (
                <div className="flex items-center">
                  <Github className="h-4 w-4 mr-2" style={{ color: colorTheme }} />
                  <span className={`${fontSizeClasses.normal}`}>{personalInfo.github}</span>
                </div>
              )}
            </div>
          </div>
        </header>
      </div>

      {/* Main content */}
      <div className="px-8 py-4 space-y-6">
        {/* Professional Summary */}
        {personalInfo.bio && (
          <section className="mb-6">
            <div className="flex items-center mb-4">
              <h2 
                className={`${fontSizeClasses.sectionHeading} font-bold mr-3`}
                style={{ color: '#2c3e50' }}
              >
                EXECUTIVE SUMMARY
              </h2>
              <div className="flex-grow h-px bg-gray-300"></div>
            </div>
            
            <p className={`${fontSizeClasses.normal} text-gray-700`}>
              {personalInfo.bio}
            </p>
          </section>
        )}

        {/* Experience */}
        {visibleSections.experience && experience.length > 0 && (
          <section className="mb-6">
            <div className="flex items-center mb-4">
              <h2 
                className={`${fontSizeClasses.sectionHeading} font-bold mr-3`}
                style={{ color: '#2c3e50' }}
              >
                PROFESSIONAL EXPERIENCE
              </h2>
              <div className="flex-grow h-px bg-gray-300"></div>
            </div>
            
            <div className="space-y-5">
              {experience.map((exp) => (
                <div key={exp.id} className="mb-4">
                  <div className="flex justify-between items-start">
                    <div>
                      <h3 className={`${fontSizeClasses.normal} font-bold`}>
                        {exp.position}
                      </h3>
                      <p className={`${fontSizeClasses.normal} font-semibold`} style={{ color: colorTheme }}>
                        {exp.company}
                      </p>
                    </div>
                    <span className={`${fontSizeClasses.normal} font-medium text-gray-600`}>
                      {exp.startDate} - {exp.isCurrentPosition ? 'Present' : exp.endDate}
                    </span>
                  </div>
                  
                  <p className={`${fontSizeClasses.normal} text-gray-700 mt-2`}>
                    {exp.description}
                  </p>
                </div>
              ))}
            </div>
          </section>
        )}

        {/* Education */}
        {visibleSections.education && education.length > 0 && (
          <section className="mb-6">
            <div className="flex items-center mb-4">
              <h2 
                className={`${fontSizeClasses.sectionHeading} font-bold mr-3`}
                style={{ color: '#2c3e50' }}
              >
                EDUCATION
              </h2>
              <div className="flex-grow h-px bg-gray-300"></div>
            </div>
            
            <div className="space-y-4">
              {education.map((edu) => (
                <div key={edu.id} className="mb-3 grid grid-cols-[3fr_1fr] gap-4">
                  <div>
                    <h3 className={`${fontSizeClasses.normal} font-bold`}>
                      {edu.degree} in {edu.fieldOfStudy}
                    </h3>
                    <h4 className={`${fontSizeClasses.normal} font-semibold`} style={{ color: colorTheme }}>
                      {edu.institution}
                    </h4>
                    {edu.description && (
                      <p className={`${fontSizeClasses.normal} text-gray-700 mt-1`}>
                        {edu.description}
                      </p>
                    )}
                  </div>
                  <div className="text-right">
                    <span className={`${fontSizeClasses.normal} font-medium text-gray-600`}>
                      {edu.startDate} - {edu.endDate}
                    </span>
                  </div>
                </div>
              ))}
            </div>
          </section>
        )}

        <div className="grid grid-cols-2 gap-8">
          {/* Skills and Competencies */}
          <div>
            {visibleSections.skills && skills.length > 0 && (
              <section className="mb-6">
                <div className="flex items-center mb-4">
                  <h2 
                    className={`${fontSizeClasses.sectionHeading} font-bold mr-3`}
                    style={{ color: '#2c3e50' }}
                  >
                    SKILLS & COMPETENCIES
                  </h2>
                  <div className="flex-grow h-px bg-gray-300"></div>
                </div>
                
                <div className="grid grid-cols-2 gap-2">
                  {skills.map((skill) => (
                    <div key={skill.id} className="mb-2 flex flex-col">
                      <div className="flex justify-between mb-1">
                        <span className={`${fontSizeClasses.normal} font-semibold`}>
                          {skill.name}
                        </span>
                      </div>
                      <div className="w-full bg-gray-200 h-1.5 rounded-full overflow-hidden">
                        <div 
                          className="h-1.5" 
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
                <div className="flex items-center mb-4">
                  <h2 
                    className={`${fontSizeClasses.sectionHeading} font-bold mr-3`}
                    style={{ color: '#2c3e50' }}
                  >
                    LANGUAGES
                  </h2>
                  <div className="flex-grow h-px bg-gray-300"></div>
                </div>
                
                <ul className="columns-2 list-inside list-disc space-y-1">
                  {languages.map((lang, index) => (
                    <li key={index} className={`${fontSizeClasses.normal}`}>{lang}</li>
                  ))}
                </ul>
              </section>
            )}
          </div>
          
          <div>
            {/* Projects */}
            {visibleSections.projects && projects.length > 0 && (
              <section className="mb-6">
                <div className="flex items-center mb-4">
                  <h2 
                    className={`${fontSizeClasses.sectionHeading} font-bold mr-3`}
                    style={{ color: '#2c3e50' }}
                  >
                    KEY PROJECTS
                  </h2>
                  <div className="flex-grow h-px bg-gray-300"></div>
                </div>
                
                <div className="space-y-3">
                  {projects.map((project) => (
                    <div key={project.id} className="mb-2">
                      <div className="flex justify-between items-start">
                        <h3 className={`${fontSizeClasses.normal} font-bold`}>
                          {project.title}
                        </h3>
                        {project.link && (
                          <a 
                            href={project.link} 
                            target="_blank" 
                            rel="noopener noreferrer"
                            className={`${fontSizeClasses.normal} underline`}
                            style={{ color: colorTheme }}
                          >
                            View Project
                          </a>
                        )}
                      </div>
                      
                      <p className={`${fontSizeClasses.normal} mt-1 text-gray-700`}>
                        {project.description}
                      </p>
                      
                      <p className={`${fontSizeClasses.normal} text-gray-600 mt-1`} style={{ color: colorTheme }}>
                        <span className="font-medium">Technologies:</span> {project.technologies}
                      </p>
                    </div>
                  ))}
                </div>
              </section>
            )}

            {/* Certifications & Hobbies */}
            <div className="grid grid-cols-2 gap-6">
              {/* Certifications */}
              {visibleSections.certifications && certifications.length > 0 && (
                <section>
                  <div className="flex items-center mb-3">
                    <h2 
                      className={`${fontSizeClasses.normal} font-bold mr-2`}
                      style={{ color: '#2c3e50' }}
                    >
                      CERTIFICATIONS
                    </h2>
                    <div className="flex-grow h-px bg-gray-300"></div>
                  </div>
                  
                  <ul className="list-disc list-inside space-y-1">
                    {certifications.map((cert, index) => (
                      <li key={index} className={`${fontSizeClasses.normal}`}>{cert}</li>
                    ))}
                  </ul>
                </section>
              )}
              
              {/* Hobbies */}
              {visibleSections.hobbies && hobbies.length > 0 && (
                <section>
                  <div className="flex items-center mb-3">
                    <h2 
                      className={`${fontSizeClasses.normal} font-bold mr-2`}
                      style={{ color: '#2c3e50' }}
                    >
                      INTERESTS
                    </h2>
                    <div className="flex-grow h-px bg-gray-300"></div>
                  </div>
                  
                  <ul className="list-disc list-inside space-y-1">
                    {hobbies.map((hobby, index) => (
                      <li key={index} className={`${fontSizeClasses.normal}`}>{hobby}</li>
                    ))}
                  </ul>
                </section>
              )}
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default ExecutiveTemplate;
