
import React from 'react';
import { useResume } from '../../contexts/ResumeContext';
import { Phone, Mail, MapPin, Linkedin, Globe, Github } from 'lucide-react';

const MinimalTemplate = () => {
  const { resumeData, customization } = useResume();
  const { personalInfo, education, experience, skills, projects, certifications, languages, hobbies } = resumeData;
  const { font, fontSize, colorTheme, visibleSections } = customization;
  
  // Font size classes based on the fontSize setting
  const fontSizeClasses = {
    name: fontSize === 'small' ? 'text-2xl' : fontSize === 'medium' ? 'text-3xl' : 'text-4xl',
    title: fontSize === 'small' ? 'text-base' : fontSize === 'medium' ? 'text-lg' : 'text-xl',
    sectionHeading: fontSize === 'small' ? 'text-base' : fontSize === 'medium' ? 'text-lg' : 'text-xl',
    normal: fontSize === 'small' ? 'text-xs' : fontSize === 'medium' ? 'text-sm' : 'text-base',
  };

  return (
    <div 
      className={`w-full h-full bg-white p-8 font-${font.toLowerCase().replace(/\s+/g, '-')} resume-preview`}
      style={{ fontSize: fontSize === 'small' ? '14px' : fontSize === 'medium' ? '16px' : '18px' }}
    >
      <header className="text-center mb-8">
        <h1 className={`${fontSizeClasses.name} font-light mb-2`}>
          {personalInfo.fullName}
        </h1>
        <h2 className={`${fontSizeClasses.title} font-light mb-4`} style={{ color: colorTheme }}>
          {personalInfo.title}
        </h2>
        
        <div className="flex flex-wrap justify-center gap-4 text-sm">
          {personalInfo.phone && (
            <div className="flex items-center">
              <Phone className="h-3 w-3 mr-1" />
              <span>{personalInfo.phone}</span>
            </div>
          )}
          {personalInfo.email && (
            <div className="flex items-center">
              <Mail className="h-3 w-3 mr-1" />
              <span>{personalInfo.email}</span>
            </div>
          )}
          {personalInfo.address && (
            <div className="flex items-center">
              <MapPin className="h-3 w-3 mr-1" />
              <span>{personalInfo.address}</span>
            </div>
          )}
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
      </header>

      {personalInfo.bio && (
        <section className="mb-6 mx-auto max-w-2xl text-center">
          <p className={`${fontSizeClasses.normal} text-gray-600`}>
            {personalInfo.bio}
          </p>
        </section>
      )}

      <div className="space-y-6 max-w-4xl mx-auto">
        {/* Experience */}
        {visibleSections.experience && experience.length > 0 && (
          <section>
            <h2 
              className={`${fontSizeClasses.sectionHeading} font-light uppercase tracking-widest text-center mb-4`}
              style={{ color: colorTheme }}
            >
              Experience
            </h2>
            <div className="space-y-4">
              {experience.map((exp) => (
                <div key={exp.id} className="grid grid-cols-[1fr_3fr] gap-4 items-start">
                  <div className="text-right">
                    <p className={`${fontSizeClasses.normal} text-gray-500`}>
                      {exp.startDate} - {exp.isCurrentPosition ? 'Present' : exp.endDate}
                    </p>
                    <p className={`${fontSizeClasses.normal} font-medium`}>
                      {exp.company}
                    </p>
                  </div>
                  <div>
                    <h3 className={`${fontSizeClasses.normal} font-medium`} style={{ color: colorTheme }}>
                      {exp.position}
                    </h3>
                    <p className={`${fontSizeClasses.normal} mt-1 text-gray-600`}>
                      {exp.description}
                    </p>
                  </div>
                </div>
              ))}
            </div>
          </section>
        )}

        {/* Education */}
        {visibleSections.education && education.length > 0 && (
          <section>
            <h2 
              className={`${fontSizeClasses.sectionHeading} font-light uppercase tracking-widest text-center mb-4`}
              style={{ color: colorTheme }}
            >
              Education
            </h2>
            <div className="space-y-4">
              {education.map((edu) => (
                <div key={edu.id} className="grid grid-cols-[1fr_3fr] gap-4 items-start">
                  <div className="text-right">
                    <p className={`${fontSizeClasses.normal} text-gray-500`}>
                      {edu.startDate} - {edu.endDate}
                    </p>
                    <p className={`${fontSizeClasses.normal} font-medium`}>
                      {edu.institution}
                    </p>
                  </div>
                  <div>
                    <h3 className={`${fontSizeClasses.normal} font-medium`} style={{ color: colorTheme }}>
                      {edu.degree} in {edu.fieldOfStudy}
                    </h3>
                    {edu.description && (
                      <p className={`${fontSizeClasses.normal} mt-1 text-gray-600`}>
                        {edu.description}
                      </p>
                    )}
                  </div>
                </div>
              ))}
            </div>
          </section>
        )}

        {/* Skills */}
        {visibleSections.skills && skills.length > 0 && (
          <section>
            <h2 
              className={`${fontSizeClasses.sectionHeading} font-light uppercase tracking-widest text-center mb-4`}
              style={{ color: colorTheme }}
            >
              Skills
            </h2>
            <div className="flex flex-wrap justify-center gap-2">
              {skills.map((skill) => (
                <span 
                  key={skill.id} 
                  className={`${fontSizeClasses.normal} px-3 py-1 border rounded-full`}
                  style={{ borderColor: colorTheme }}
                >
                  {skill.name}
                </span>
              ))}
            </div>
          </section>
        )}

        {/* Projects */}
        {visibleSections.projects && projects.length > 0 && (
          <section>
            <h2 
              className={`${fontSizeClasses.sectionHeading} font-light uppercase tracking-widest text-center mb-4`}
              style={{ color: colorTheme }}
            >
              Projects
            </h2>
            <div className="space-y-4">
              {projects.map((project) => (
                <div key={project.id} className="grid grid-cols-[1fr_3fr] gap-4 items-start">
                  <div className="text-right">
                    <p className={`${fontSizeClasses.normal} font-medium`} style={{ color: colorTheme }}>
                      {project.title}
                    </p>
                    {project.link && (
                      <a 
                        href={project.link} 
                        target="_blank" 
                        rel="noopener noreferrer"
                        className={`${fontSizeClasses.normal} text-gray-500 underline`}
                      >
                        View Project
                      </a>
                    )}
                  </div>
                  <div>
                    <p className={`${fontSizeClasses.normal} text-gray-600`}>
                      {project.description}
                    </p>
                    <p className={`${fontSizeClasses.normal} mt-1 text-gray-500`}>
                      <span className="italic">Technologies:</span> {project.technologies}
                    </p>
                  </div>
                </div>
              ))}
            </div>
          </section>
        )}

        <div className="grid grid-cols-3 gap-6">
          {/* Certifications */}
          {visibleSections.certifications && certifications.length > 0 && (
            <div>
              <h3 
                className={`${fontSizeClasses.normal} font-light uppercase tracking-widest text-center mb-3`}
                style={{ color: colorTheme }}
              >
                Certifications
              </h3>
              <ul className="text-center space-y-1">
                {certifications.map((cert, index) => (
                  <li key={index} className={`${fontSizeClasses.normal}`}>
                    {cert}
                  </li>
                ))}
              </ul>
            </div>
          )}

          {/* Languages */}
          {visibleSections.languages && languages.length > 0 && (
            <div>
              <h3 
                className={`${fontSizeClasses.normal} font-light uppercase tracking-widest text-center mb-3`}
                style={{ color: colorTheme }}
              >
                Languages
              </h3>
              <ul className="text-center space-y-1">
                {languages.map((lang, index) => (
                  <li key={index} className={`${fontSizeClasses.normal}`}>
                    {lang}
                  </li>
                ))}
              </ul>
            </div>
          )}

          {/* Hobbies */}
          {visibleSections.hobbies && hobbies.length > 0 && (
            <div>
              <h3 
                className={`${fontSizeClasses.normal} font-light uppercase tracking-widest text-center mb-3`}
                style={{ color: colorTheme }}
              >
                Interests
              </h3>
              <ul className="text-center space-y-1">
                {hobbies.map((hobby, index) => (
                  <li key={index} className={`${fontSizeClasses.normal}`}>
                    {hobby}
                  </li>
                ))}
              </ul>
            </div>
          )}
        </div>
      </div>
    </div>
  );
};

export default MinimalTemplate;
