
import React from 'react';
import { useResume } from '../../contexts/ResumeContext';
import { Phone, Mail, MapPin, Linkedin, Globe, Github } from 'lucide-react';

const CorporateTemplate = () => {
  const { resumeData, customization } = useResume();
  const { personalInfo, education, experience, skills, projects, certifications, languages, hobbies } = resumeData;
  const { font, fontSize, colorTheme, visibleSections } = customization;

  // Font size classes based on the fontSize setting
  const fontSizeClasses = {
    name: fontSize === 'small' ? 'text-2xl' : fontSize === 'medium' ? 'text-3xl' : 'text-4xl',
    title: fontSize === 'small' ? 'text-base' : fontSize === 'medium' ? 'text-lg' : 'text-xl',
    sectionHeading: fontSize === 'small' ? 'text-lg' : fontSize === 'medium' ? 'text-xl' : 'text-2xl',
    normal: fontSize === 'small' ? 'text-xs' : fontSize === 'medium' ? 'text-sm' : 'text-base',
  };

  return (
    <div 
      className={`w-full h-full bg-white font-${font.toLowerCase().replace(/\s+/g, '-')} resume-preview`}
      style={{ fontSize: fontSize === 'small' ? '14px' : fontSize === 'medium' ? '16px' : '18px' }}
    >
      {/* Header with corporate blue background */}
      <header 
        className="px-8 py-6 text-white"
        style={{ backgroundColor: colorTheme }}
      >
        <div className="flex items-center justify-between">
          <div>
            <h1 className={`${fontSizeClasses.name} font-bold mb-2`}>
              {personalInfo.fullName}
            </h1>
            <h2 className={`${fontSizeClasses.title} mb-4`}>
              {personalInfo.title}
            </h2>
            
            <div className="grid grid-cols-2 gap-x-4 gap-y-2">
              {personalInfo.phone && (
                <div className="flex items-center">
                  <Phone className="h-4 w-4 mr-2 opacity-80" />
                  <span className={`${fontSizeClasses.normal}`}>{personalInfo.phone}</span>
                </div>
              )}
              {personalInfo.email && (
                <div className="flex items-center">
                  <Mail className="h-4 w-4 mr-2 opacity-80" />
                  <span className={`${fontSizeClasses.normal}`}>{personalInfo.email}</span>
                </div>
              )}
              {personalInfo.address && (
                <div className="flex items-center">
                  <MapPin className="h-4 w-4 mr-2 opacity-80" />
                  <span className={`${fontSizeClasses.normal}`}>{personalInfo.address}</span>
                </div>
              )}
              {personalInfo.linkedin && (
                <div className="flex items-center">
                  <Linkedin className="h-4 w-4 mr-2 opacity-80" />
                  <span className={`${fontSizeClasses.normal}`}>{personalInfo.linkedin}</span>
                </div>
              )}
              {personalInfo.website && (
                <div className="flex items-center">
                  <Globe className="h-4 w-4 mr-2 opacity-80" />
                  <span className={`${fontSizeClasses.normal}`}>{personalInfo.website}</span>
                </div>
              )}
              {personalInfo.github && (
                <div className="flex items-center">
                  <Github className="h-4 w-4 mr-2 opacity-80" />
                  <span className={`${fontSizeClasses.normal}`}>{personalInfo.github}</span>
                </div>
              )}
            </div>
          </div>
          
          {personalInfo.profileImage && (
            <div className="ml-4">
              <img 
                src={personalInfo.profileImage} 
                alt={personalInfo.fullName}
                className="w-28 h-28 rounded border-4 border-white/30 object-cover shadow-md"
              />
            </div>
          )}
        </div>
      </header>
      
      <div className="p-8">
        {/* Professional Summary */}
        {personalInfo.bio && (
          <section className="mb-6">
            <h2 
              className={`${fontSizeClasses.sectionHeading} font-bold mb-3 uppercase tracking-wider`}
              style={{ color: colorTheme }}
            >
              Professional Profile
            </h2>
            <div className="pl-4 border-l-4" style={{ borderColor: colorTheme }}>
              <p className={`${fontSizeClasses.normal} text-gray-700`}>
                {personalInfo.bio}
              </p>
            </div>
          </section>
        )}
        
        <div className="grid grid-cols-3 gap-8">
          {/* Main Content - Experience & Education */}
          <div className="col-span-2 space-y-6">
            {/* Experience */}
            {visibleSections.experience && experience.length > 0 && (
              <section>
                <h2 
                  className={`${fontSizeClasses.sectionHeading} font-bold mb-4 uppercase tracking-wider`}
                  style={{ color: colorTheme }}
                >
                  Professional Experience
                </h2>
                
                <div className="space-y-5">
                  {experience.map((exp) => (
                    <div key={exp.id} className="mb-4 pb-4 border-b last:border-0" style={{ borderColor: `${colorTheme}30` }}>
                      <div className="flex justify-between items-start">
                        <div>
                          <h3 className={`${fontSizeClasses.normal} font-bold`}>
                            {exp.position}
                          </h3>
                          <h4 
                            className={`${fontSizeClasses.normal} font-medium`}
                            style={{ color: colorTheme }}
                          >
                            {exp.company}
                          </h4>
                        </div>
                        <span 
                          className={`${fontSizeClasses.normal} px-3 py-1 rounded-sm text-white`}
                          style={{ backgroundColor: colorTheme }}
                        >
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
              <section>
                <h2 
                  className={`${fontSizeClasses.sectionHeading} font-bold mb-4 uppercase tracking-wider`}
                  style={{ color: colorTheme }}
                >
                  Education
                </h2>
                
                <div className="space-y-4">
                  {education.map((edu) => (
                    <div key={edu.id} className="mb-3 pb-3 border-b last:border-0" style={{ borderColor: `${colorTheme}30` }}>
                      <div className="flex justify-between items-start">
                        <div>
                          <h3 className={`${fontSizeClasses.normal} font-bold`}>
                            {edu.degree} in {edu.fieldOfStudy}
                          </h3>
                          <h4 
                            className={`${fontSizeClasses.normal} font-medium`}
                            style={{ color: colorTheme }}
                          >
                            {edu.institution}
                          </h4>
                        </div>
                        <span 
                          className={`${fontSizeClasses.normal} px-3 py-1 rounded-sm text-white`}
                          style={{ backgroundColor: colorTheme }}
                        >
                          {edu.startDate} - {edu.endDate}
                        </span>
                      </div>
                      
                      {edu.description && (
                        <p className={`${fontSizeClasses.normal} text-gray-700 mt-2`}>
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
                  className={`${fontSizeClasses.sectionHeading} font-bold mb-4 uppercase tracking-wider`}
                  style={{ color: colorTheme }}
                >
                  Key Projects
                </h2>
                
                <div className="space-y-4">
                  {projects.map((project) => (
                    <div key={project.id} className="mb-3 pb-3 border-b last:border-0" style={{ borderColor: `${colorTheme}30` }}>
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
                      
                      <p className={`${fontSizeClasses.normal} text-gray-700 mt-1`}>
                        {project.description}
                      </p>
                      
                      <div className="mt-2">
                        <span className={`${fontSizeClasses.normal} font-bold`}>Technologies: </span>
                        <span className={`${fontSizeClasses.normal}`}>{project.technologies}</span>
                      </div>
                    </div>
                  ))}
                </div>
              </section>
            )}
          </div>
          
          {/* Sidebar Content - Skills, Certifications, Languages, Hobbies */}
          <div className="space-y-6">
            {/* Skills */}
            {visibleSections.skills && skills.length > 0 && (
              <section 
                className="p-4 rounded-sm"
                style={{ backgroundColor: `${colorTheme}10` }}
              >
                <h2 
                  className={`${fontSizeClasses.sectionHeading} font-bold mb-3 uppercase tracking-wider`}
                  style={{ color: colorTheme }}
                >
                  Skills
                </h2>
                
                <div className="space-y-3">
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
                      <div className="w-full bg-gray-200 rounded-sm h-2">
                        <div 
                          className="h-2 rounded-sm" 
                          style={{ width: `${skill.level}%`, backgroundColor: colorTheme }}
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
                  className={`${fontSizeClasses.sectionHeading} font-bold mb-3 uppercase tracking-wider`}
                  style={{ color: colorTheme }}
                >
                  Certifications
                </h2>
                
                <div className="space-y-2">
                  {certifications.map((cert, index) => (
                    <div 
                      key={index} 
                      className={`${fontSizeClasses.normal} p-2 border-l-4 bg-gray-50`}
                      style={{ borderColor: colorTheme }}
                    >
                      {cert}
                    </div>
                  ))}
                </div>
              </section>
            )}
            
            {/* Languages */}
            {visibleSections.languages && languages.length > 0 && (
              <section>
                <h2 
                  className={`${fontSizeClasses.sectionHeading} font-bold mb-3 uppercase tracking-wider`}
                  style={{ color: colorTheme }}
                >
                  Languages
                </h2>
                
                <ul className="list-disc list-inside pl-2 space-y-1">
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
                  className={`${fontSizeClasses.sectionHeading} font-bold mb-3 uppercase tracking-wider`}
                  style={{ color: colorTheme }}
                >
                  Interests
                </h2>
                
                <div className="flex flex-wrap gap-2">
                  {hobbies.map((hobby, index) => (
                    <span 
                      key={index} 
                      className={`${fontSizeClasses.normal} px-3 py-1 border rounded-sm`}
                      style={{ borderColor: colorTheme, color: colorTheme }}
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
    </div>
  );
};

export default CorporateTemplate;
