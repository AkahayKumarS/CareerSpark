
import React from 'react';
import { useResume } from '../../contexts/ResumeContext';
import { Phone, Mail, MapPin, Linkedin, Globe, Github } from 'lucide-react';

const ElegantTemplate = () => {
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

  // Add serif font style for elegant template
  const elegantFontClasses = {
    heading: 'font-serif italic',
    name: 'font-serif',
  };

  return (
    <div 
      className={`w-full h-full bg-white font-${font.toLowerCase().replace(/\s+/g, '-')} resume-preview p-8`}
      style={{ 
        fontSize: fontSize === 'small' ? '14px' : fontSize === 'medium' ? '16px' : '18px',
        backgroundImage: 'radial-gradient(circle at top right, #f9f9f9, #ffffff)'
      }}
    >
      {/* Header with elegant design */}
      <header className="mb-8 relative">
        <div 
          className="absolute top-0 right-0 w-48 h-48 rounded-full opacity-10"
          style={{ backgroundColor: colorTheme, filter: 'blur(40px)' }}
        ></div>
        
        <div className="flex items-end justify-between relative">
          <div>
            <h1 className={`${fontSizeClasses.name} ${elegantFontClasses.name} mb-2 tracking-wide`}>
              {personalInfo.fullName}
            </h1>
            <h2 
              className={`${fontSizeClasses.title} italic mb-4 tracking-wide`}
              style={{ color: colorTheme }}
            >
              {personalInfo.title}
            </h2>
          </div>
          
          {personalInfo.profileImage && (
            <div className="relative">
              <div 
                className="absolute inset-0 rounded-full"
                style={{ 
                  border: `2px solid ${colorTheme}`,
                  transform: 'translate(4px, 4px)',
                  zIndex: 0 
                }}
              ></div>
              <img 
                src={personalInfo.profileImage}
                alt={personalInfo.fullName}
                className="w-24 h-24 rounded-full object-cover relative z-10"
              />
            </div>
          )}
        </div>
        
        <div className="mt-4 flex flex-wrap gap-4 text-gray-600 border-t border-b py-4" style={{ borderColor: `${colorTheme}20` }}>
          {personalInfo.phone && (
            <div className="flex items-center">
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
          {personalInfo.address && (
            <div className="flex items-center">
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
          {personalInfo.website && (
            <div className="flex items-center">
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
      </header>
      
      {/* Professional Summary */}
      {personalInfo.bio && (
        <section className="mb-8">
          <h2 
            className={`${fontSizeClasses.sectionHeading} ${elegantFontClasses.heading} mb-4`}
            style={{ color: colorTheme }}
          >
            About Me
          </h2>
          <p className={`${fontSizeClasses.normal} text-gray-700 leading-relaxed`}>
            {personalInfo.bio}
          </p>
        </section>
      )}
      
      <div className="grid grid-cols-3 gap-8">
        {/* Left column: Experience and Education */}
        <div className="col-span-2 space-y-8">
          {/* Experience */}
          {visibleSections.experience && experience.length > 0 && (
            <section>
              <h2 
                className={`${fontSizeClasses.sectionHeading} ${elegantFontClasses.heading} mb-4`}
                style={{ color: colorTheme }}
              >
                Professional Experience
              </h2>
              
              <div className="space-y-6">
                {experience.map((exp) => (
                  <div key={exp.id} className="mb-5">
                    <div className="flex justify-between items-start mb-1">
                      <h3 className={`${fontSizeClasses.normal} font-bold`}>
                        {exp.position}
                      </h3>
                      <span 
                        className={`${fontSizeClasses.normal} text-gray-600 italic`}
                      >
                        {exp.startDate} - {exp.isCurrentPosition ? 'Present' : exp.endDate}
                      </span>
                    </div>
                    
                    <h4 
                      className={`${fontSizeClasses.normal} font-medium mb-2`}
                      style={{ color: colorTheme }}
                    >
                      {exp.company}
                    </h4>
                    
                    <p className={`${fontSizeClasses.normal} text-gray-700 leading-relaxed`}>
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
                className={`${fontSizeClasses.sectionHeading} ${elegantFontClasses.heading} mb-4`}
                style={{ color: colorTheme }}
              >
                Notable Projects
              </h2>
              
              <div className="space-y-5">
                {projects.map((project) => (
                  <div key={project.id} className="mb-4">
                    <div className="flex justify-between items-start">
                      <h3 className={`${fontSizeClasses.normal} font-bold`}>
                        {project.title}
                      </h3>
                      
                      {project.link && (
                        <a 
                          href={project.link}
                          target="_blank"
                          rel="noopener noreferrer"
                          className={`${fontSizeClasses.normal} italic underline`}
                          style={{ color: colorTheme }}
                        >
                          View Project
                        </a>
                      )}
                    </div>
                    
                    <p className={`${fontSizeClasses.normal} text-gray-700 my-2 leading-relaxed`}>
                      {project.description}
                    </p>
                    
                    <div 
                      className={`${fontSizeClasses.normal} italic`}
                      style={{ color: colorTheme }}
                    >
                      <span className="font-medium not-italic">Technologies:</span> {project.technologies}
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
                className={`${fontSizeClasses.sectionHeading} ${elegantFontClasses.heading} mb-4`}
                style={{ color: colorTheme }}
              >
                Education
              </h2>
              
              <div className="space-y-5">
                {education.map((edu) => (
                  <div key={edu.id} className="mb-4">
                    <div className="flex justify-between items-start mb-1">
                      <h3 className={`${fontSizeClasses.normal} font-bold`}>
                        {edu.degree} in {edu.fieldOfStudy}
                      </h3>
                      <span className={`${fontSizeClasses.normal} text-gray-600 italic`}>
                        {edu.startDate} - {edu.endDate}
                      </span>
                    </div>
                    
                    <h4 
                      className={`${fontSizeClasses.normal} font-medium mb-1`}
                      style={{ color: colorTheme }}
                    >
                      {edu.institution}
                    </h4>
                    
                    {edu.description && (
                      <p className={`${fontSizeClasses.normal} text-gray-700 leading-relaxed`}>
                        {edu.description}
                      </p>
                    )}
                  </div>
                ))}
              </div>
            </section>
          )}
        </div>
        
        {/* Right column: Skills, Languages, Certifications, Hobbies */}
        <div className="space-y-6">
          {/* Skills */}
          {visibleSections.skills && skills.length > 0 && (
            <section 
              className="p-5 rounded-lg" 
              style={{ backgroundColor: `${colorTheme}10` }}
            >
              <h2 
                className={`${fontSizeClasses.sectionHeading} ${elegantFontClasses.heading} mb-4`}
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
                    </div>
                    <div className="w-full bg-white bg-opacity-60 rounded-full h-1.5 overflow-hidden">
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
          
          {/* Certifications */}
          {visibleSections.certifications && certifications.length > 0 && (
            <section>
              <h2 
                className={`${fontSizeClasses.sectionHeading} ${elegantFontClasses.heading} mb-3`}
                style={{ color: colorTheme }}
              >
                Certifications
              </h2>
              
              <ul className="space-y-2">
                {certifications.map((cert, index) => (
                  <li 
                    key={index} 
                    className={`${fontSizeClasses.normal} flex items-center`}
                  >
                    <span 
                      className="w-1.5 h-1.5 rounded-full mr-2"
                      style={{ backgroundColor: colorTheme }}
                    ></span>
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
                className={`${fontSizeClasses.sectionHeading} ${elegantFontClasses.heading} mb-3`}
                style={{ color: colorTheme }}
              >
                Languages
              </h2>
              
              <ul className="space-y-2">
                {languages.map((lang, index) => (
                  <li 
                    key={index} 
                    className={`${fontSizeClasses.normal} flex items-center`}
                  >
                    <span 
                      className="w-1.5 h-1.5 rounded-full mr-2"
                      style={{ backgroundColor: colorTheme }}
                    ></span>
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
                className={`${fontSizeClasses.sectionHeading} ${elegantFontClasses.heading} mb-3`}
                style={{ color: colorTheme }}
              >
                Interests
              </h2>
              
              <div className="flex flex-wrap gap-2">
                {hobbies.map((hobby, index) => (
                  <span 
                    key={index} 
                    className={`${fontSizeClasses.normal} px-3 py-1 rounded-full text-white`}
                    style={{ backgroundColor: colorTheme }}
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

export default ElegantTemplate;
