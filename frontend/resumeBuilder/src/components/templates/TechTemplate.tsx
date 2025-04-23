
import React from 'react';
import { useResume } from '../../contexts/ResumeContext';
import { Phone, Mail, MapPin, Linkedin, Globe, Github, Code, CheckCircle } from 'lucide-react';

const TechTemplate = () => {
  const { resumeData, customization } = useResume();
  const { personalInfo, education, experience, skills, projects, certifications, languages, hobbies } = resumeData;
  const { font, fontSize, colorTheme, visibleSections } = customization;

  // Font size classes based on the fontSize setting
  const fontSizeClasses = {
    name: fontSize === 'small' ? 'text-2xl' : fontSize === 'medium' ? 'text-3xl' : 'text-4xl',
    title: fontSize === 'small' ? 'text-lg' : fontSize === 'medium' ? 'text-xl' : 'text-2xl',
    sectionHeading: fontSize === 'small' ? 'text-base' : fontSize === 'medium' ? 'text-lg' : 'text-xl',
    normal: fontSize === 'small' ? 'text-xs' : fontSize === 'medium' ? 'text-sm' : 'text-base',
  };

  return (
    <div 
      className={`w-full h-full bg-slate-900 text-white font-${font.toLowerCase().replace(/\s+/g, '-')} resume-preview`}
      style={{ fontSize: fontSize === 'small' ? '14px' : fontSize === 'medium' ? '16px' : '18px' }}
    >
      <div className="grid grid-cols-3 h-full">
        <div className="col-span-1 bg-slate-800 p-6 flex flex-col">
          {/* Profile section */}
          <div className="mb-8 text-center">
            {personalInfo.profileImage ? (
              <img 
                src={personalInfo.profileImage} 
                alt={personalInfo.fullName}
                className="w-32 h-32 rounded-full mx-auto mb-4 object-cover border-4"
                style={{ borderColor: colorTheme }}
              />
            ) : (
              <div 
                className="w-32 h-32 rounded-full mx-auto mb-4 flex items-center justify-center text-3xl font-bold"
                style={{ backgroundColor: colorTheme }}
              >
                {personalInfo.fullName.split(' ').map(name => name[0]).join('')}
              </div>
            )}
            
            <h1 className={`${fontSizeClasses.name} font-bold`}>
              {personalInfo.fullName}
            </h1>
            <h2 
              className={`${fontSizeClasses.title} mt-1 mb-2`} 
              style={{ color: colorTheme }}
            >
              {personalInfo.title}
            </h2>
            
            {personalInfo.github && (
              <div className="flex items-center justify-center mt-2 text-gray-300">
                <Github className="h-4 w-4 mr-1" style={{ color: colorTheme }} />
                <span className={`${fontSizeClasses.normal}`}>{personalInfo.github}</span>
              </div>
            )}
          </div>
          
          {/* Contact Info */}
          <div className="mb-6">
            <h3 
              className={`${fontSizeClasses.sectionHeading} font-bold mb-3 pb-1 border-b flex items-center`}
              style={{ borderColor: colorTheme, color: colorTheme }}
            >
              <Code className="h-4 w-4 mr-1" />
              CONTACT
            </h3>
            
            <div className="space-y-2 text-gray-300">
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
            </div>
          </div>
          
          {/* Technical Skills */}
          {visibleSections.skills && skills.length > 0 && (
            <div className="mb-6">
              <h3 
                className={`${fontSizeClasses.sectionHeading} font-bold mb-3 pb-1 border-b flex items-center`}
                style={{ borderColor: colorTheme, color: colorTheme }}
              >
                <Code className="h-4 w-4 mr-1" />
                TECHNICAL SKILLS
              </h3>
              
              <div className="space-y-3">
                {skills.map((skill) => (
                  <div key={skill.id} className="mb-2">
                    <div className="flex justify-between mb-1">
                      <span className={`${fontSizeClasses.normal} font-medium text-gray-300`}>
                        {skill.name}
                      </span>
                      <span className={`${fontSizeClasses.normal}`} style={{ color: colorTheme }}>
                        {skill.level}%
                      </span>
                    </div>
                    <div className="w-full bg-slate-700 rounded-full h-1.5">
                      <div 
                        className="h-1.5 rounded-full" 
                        style={{ width: `${skill.level}%`, backgroundColor: colorTheme }}
                      ></div>
                    </div>
                  </div>
                ))}
              </div>
            </div>
          )}
          
          {/* Languages */}
          {visibleSections.languages && languages.length > 0 && (
            <div className="mb-6">
              <h3 
                className={`${fontSizeClasses.sectionHeading} font-bold mb-3 pb-1 border-b flex items-center`}
                style={{ borderColor: colorTheme, color: colorTheme }}
              >
                <Code className="h-4 w-4 mr-1" />
                LANGUAGES
              </h3>
              
              <ul className="space-y-1 text-gray-300">
                {languages.map((lang, index) => (
                  <li key={index} className={`${fontSizeClasses.normal} flex items-center`}>
                    <CheckCircle className="h-3 w-3 mr-2" style={{ color: colorTheme }} />
                    {lang}
                  </li>
                ))}
              </ul>
            </div>
          )}
          
          {/* Hobbies & Interests */}
          {visibleSections.hobbies && hobbies.length > 0 && (
            <div className="mt-auto">
              <h3 
                className={`${fontSizeClasses.sectionHeading} font-bold mb-3 pb-1 border-b flex items-center`}
                style={{ borderColor: colorTheme, color: colorTheme }}
              >
                <Code className="h-4 w-4 mr-1" />
                INTERESTS
              </h3>
              
              <div className="flex flex-wrap gap-2">
                {hobbies.map((hobby, index) => (
                  <span 
                    key={index} 
                    className={`${fontSizeClasses.normal} py-1 px-2 rounded-md text-gray-300`}
                    style={{ backgroundColor: 'rgba(255,255,255,0.1)' }}
                  >
                    {hobby}
                  </span>
                ))}
              </div>
            </div>
          )}
        </div>
        
        <div className="col-span-2 p-8 space-y-6">
          {/* Summary */}
          {personalInfo.bio && (
            <section>
              <h2 
                className={`${fontSizeClasses.sectionHeading} font-bold mb-3 pb-1 border-b inline-block`}
                style={{ borderColor: colorTheme, color: colorTheme }}
              >
                {`console.log("ABOUT ME")`}
              </h2>
              
              <div 
                className="p-4 bg-slate-800 rounded-md border-l-4"
                style={{ borderColor: colorTheme }}
              >
                <p className={`${fontSizeClasses.normal} text-gray-300 font-mono`}>
                  {personalInfo.bio}
                </p>
              </div>
            </section>
          )}
          
          {/* Work Experience */}
          {visibleSections.experience && experience.length > 0 && (
            <section>
              <h2 
                className={`${fontSizeClasses.sectionHeading} font-bold mb-3 pb-1 border-b inline-block`}
                style={{ borderColor: colorTheme, color: colorTheme }}
              >
                {`function workExperience() {`}
              </h2>
              
              <div className="space-y-4 pl-4">
                {experience.map((exp) => (
                  <div key={exp.id} className="mb-4 relative">
                    <div 
                      className="absolute left-[-24px] top-0 w-2 h-2 rounded-full"
                      style={{ backgroundColor: colorTheme }}
                    ></div>
                    
                    <div className="flex justify-between items-center">
                      <h3 className={`${fontSizeClasses.normal} font-bold`} style={{ color: colorTheme }}>
                        {exp.position}
                      </h3>
                      <span className={`${fontSizeClasses.normal} text-gray-400 bg-slate-800 px-2 py-0.5 rounded`}>
                        {exp.startDate} - {exp.isCurrentPosition ? 'Present' : exp.endDate}
                      </span>
                    </div>
                    
                    <h4 className={`${fontSizeClasses.normal} text-gray-300 mb-1`}>
                      {exp.company}
                    </h4>
                    
                    <p className={`${fontSizeClasses.normal} text-gray-400`}>
                      {exp.description}
                    </p>
                  </div>
                ))}
              </div>
              
              <div className="text-right" style={{ color: colorTheme }}>
                <span className="font-mono">{`}`}</span>
              </div>
            </section>
          )}
          
          {/* Projects */}
          {visibleSections.projects && projects.length > 0 && (
            <section>
              <h2 
                className={`${fontSizeClasses.sectionHeading} font-bold mb-3 pb-1 border-b inline-block`}
                style={{ borderColor: colorTheme, color: colorTheme }}
              >
                {`class Projects {`}
              </h2>
              
              <div className="space-y-4 pl-4">
                {projects.map((project) => (
                  <div key={project.id} className="mb-4 bg-slate-800 p-4 rounded-md">
                    <div className="flex justify-between items-center">
                      <h3 className={`${fontSizeClasses.normal} font-bold`} style={{ color: colorTheme }}>
                        {project.title}
                      </h3>
                      
                      {project.link && (
                        <a 
                          href={project.link} 
                          target="_blank" 
                          rel="noopener noreferrer"
                          className={`${fontSizeClasses.normal} underline font-mono text-xs`}
                          style={{ color: colorTheme }}
                        >
                          github.com/link
                        </a>
                      )}
                    </div>
                    
                    <p className={`${fontSizeClasses.normal} text-gray-300 mt-2`}>
                      {project.description}
                    </p>
                    
                    <div className="mt-2 flex flex-wrap gap-1">
                      {project.technologies.split(',').map((tech, i) => (
                        <span 
                          key={i}
                          className={`${fontSizeClasses.normal} text-xs px-2 py-0.5 rounded font-mono`}
                          style={{ backgroundColor: colorTheme, color: '#000' }}
                        >
                          {tech.trim()}
                        </span>
                      ))}
                    </div>
                  </div>
                ))}
              </div>
              
              <div className="text-right" style={{ color: colorTheme }}>
                <span className="font-mono">{`}`}</span>
              </div>
            </section>
          )}
          
          {/* Education */}
          {visibleSections.education && education.length > 0 && (
            <section>
              <h2 
                className={`${fontSizeClasses.sectionHeading} font-bold mb-3 pb-1 border-b inline-block`}
                style={{ borderColor: colorTheme, color: colorTheme }}
              >
                {`let education = [`}
              </h2>
              
              <div className="space-y-4 pl-4">
                {education.map((edu, index) => (
                  <div key={edu.id} className="mb-2">
                    <div className="flex justify-between items-center">
                      <h3 className={`${fontSizeClasses.normal} font-bold`} style={{ color: colorTheme }}>
                        {edu.degree} in {edu.fieldOfStudy}
                      </h3>
                      <span className={`${fontSizeClasses.normal} text-gray-400`}>
                        {edu.startDate} - {edu.endDate}
                      </span>
                    </div>
                    
                    <h4 className={`${fontSizeClasses.normal} text-gray-300 mb-1`}>
                      {edu.institution}
                    </h4>
                    
                    {edu.description && (
                      <p className={`${fontSizeClasses.normal} text-gray-400`}>
                        {edu.description}
                      </p>
                    )}
                  </div>
                ))}
              </div>
              
              <div className="text-right" style={{ color: colorTheme }}>
                <span className="font-mono">{`];`}</span>
              </div>
            </section>
          )}
          
          {/* Certifications */}
          {visibleSections.certifications && certifications.length > 0 && (
            <section>
              <h2 
                className={`${fontSizeClasses.sectionHeading} font-bold mb-3 pb-1 border-b inline-block`}
                style={{ borderColor: colorTheme, color: colorTheme }}
              >
                {`const certifications = [`}
              </h2>
              
              <div className="flex flex-wrap gap-2 pl-4">
                {certifications.map((cert, index) => (
                  <div 
                    key={index}
                    className={`${fontSizeClasses.normal} px-3 py-1 rounded bg-slate-800 text-gray-300`}
                  >
                    {cert}
                  </div>
                ))}
              </div>
              
              <div className="text-right" style={{ color: colorTheme }}>
                <span className="font-mono">{`];`}</span>
              </div>
            </section>
          )}
        </div>
      </div>
    </div>
  );
};

export default TechTemplate;
