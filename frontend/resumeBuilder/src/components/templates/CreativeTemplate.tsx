
import React from 'react';
import { useResume } from '../../contexts/ResumeContext';
import { Phone, Mail, MapPin, Linkedin, Globe, Github } from 'lucide-react';

const CreativeTemplate = () => {
  const { resumeData, customization } = useResume();
  const { personalInfo, education, experience, skills, projects, certifications, languages, hobbies } = resumeData;
  const { font, fontSize, colorTheme, visibleSections } = customization;

  // Font size classes based on the fontSize setting
  const fontSizeClasses = {
    name: fontSize === 'small' ? 'text-3xl' : fontSize === 'medium' ? 'text-4xl' : 'text-5xl',
    title: fontSize === 'small' ? 'text-lg' : fontSize === 'medium' ? 'text-xl' : 'text-2xl',
    sectionHeading: fontSize === 'small' ? 'text-xl' : fontSize === 'medium' ? 'text-2xl' : 'text-3xl',
    normal: fontSize === 'small' ? 'text-xs' : fontSize === 'medium' ? 'text-sm' : 'text-base',
  };

  return (
    <div 
      className={`w-full h-full bg-white font-${font.toLowerCase().replace(/\s+/g, '-')} resume-preview`}
      style={{ fontSize: fontSize === 'small' ? '14px' : fontSize === 'medium' ? '16px' : '18px' }}
    >
      {/* Creative diagonal header */}
      <div 
        className="relative h-60 overflow-hidden" 
        style={{ background: `linear-gradient(135deg, ${colorTheme} 0%, ${colorTheme}aa 100%)` }}
      >
        <div className="absolute top-0 left-0 w-full h-full" style={{ background: 'radial-gradient(circle at top right, rgba(255,255,255,0.3) 0%, rgba(255,255,255,0) 60%)' }}></div>
        
        <div className="relative z-10 p-8 flex items-center h-full">
          <div>
            <h1 className={`${fontSizeClasses.name} font-bold text-white mb-2`}>
              {personalInfo.fullName}
            </h1>
            <h2 className={`${fontSizeClasses.title} font-medium text-white opacity-90`}>
              {personalInfo.title}
            </h2>
          </div>
          
          {personalInfo.profileImage && (
            <div className="ml-auto">
              <div className="w-32 h-32 rounded-full overflow-hidden border-4 border-white shadow-lg">
                <img 
                  src={personalInfo.profileImage} 
                  alt={personalInfo.fullName} 
                  className="w-full h-full object-cover"
                />
              </div>
            </div>
          )}
        </div>
        
        {/* Diagonal shape */}
        <div 
          className="absolute bottom-0 left-0 right-0 h-16" 
          style={{ 
            background: 'white',
            clipPath: 'polygon(0 100%, 100% 0, 100% 100%, 0% 100%)'
          }}
        ></div>
      </div>
      
      <div className="p-8 grid grid-cols-3 gap-6">
        {/* Left sidebar */}
        <div className="col-span-1 space-y-6">
          {/* Contact Information */}
          <section className="bg-gray-50 p-4 rounded-lg">
            <h3 
              className={`${fontSizeClasses.normal} font-bold mb-3 pb-2 border-b`}
              style={{ borderColor: colorTheme, color: colorTheme }}
            >
              CONTACT
            </h3>
            
            <div className="space-y-2">
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
          </section>
          
          {/* Skills */}
          {visibleSections.skills && skills.length > 0 && (
            <section className="bg-gray-50 p-4 rounded-lg">
              <h3 
                className={`${fontSizeClasses.normal} font-bold mb-3 pb-2 border-b`}
                style={{ borderColor: colorTheme, color: colorTheme }}
              >
                SKILLS
              </h3>
              
              <div className="space-y-2">
                {skills.map((skill) => (
                  <div key={skill.id} className="mb-2">
                    <div className="flex justify-between mb-1">
                      <span className={`${fontSizeClasses.normal} font-medium`}>{skill.name}</span>
                      <span className={`${fontSizeClasses.normal} text-gray-500`}>{skill.level}%</span>
                    </div>
                    <div className="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                      <div 
                        className="h-2 rounded-full" 
                        style={{ width: `${skill.level}%`, backgroundColor: colorTheme }}
                      ></div>
                    </div>
                  </div>
                ))}
              </div>
            </section>
          )}
          
          {/* Education */}
          {visibleSections.education && education.length > 0 && (
            <section className="bg-gray-50 p-4 rounded-lg">
              <h3 
                className={`${fontSizeClasses.normal} font-bold mb-3 pb-2 border-b`}
                style={{ borderColor: colorTheme, color: colorTheme }}
              >
                EDUCATION
              </h3>
              
              <div className="space-y-3">
                {education.map((edu) => (
                  <div key={edu.id} className="mb-3">
                    <h4 className={`${fontSizeClasses.normal} font-bold`}>
                      {edu.degree} in {edu.fieldOfStudy}
                    </h4>
                    <p className={`${fontSizeClasses.normal} font-medium text-gray-600`}>
                      {edu.institution}
                    </p>
                    <p className={`${fontSizeClasses.normal} text-gray-500`}>
                      {edu.startDate} - {edu.endDate}
                    </p>
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
          
          {/* Languages & Hobbies */}
          <div className="grid grid-cols-1 gap-3">
            {/* Languages */}
            {visibleSections.languages && languages.length > 0 && (
              <section className="bg-gray-50 p-4 rounded-lg">
                <h3 
                  className={`${fontSizeClasses.normal} font-bold mb-2 pb-1 border-b`}
                  style={{ borderColor: colorTheme, color: colorTheme }}
                >
                  LANGUAGES
                </h3>
                
                <ul className="list-disc pl-4 space-y-1">
                  {languages.map((lang, index) => (
                    <li key={index} className={`${fontSizeClasses.normal}`}>{lang}</li>
                  ))}
                </ul>
              </section>
            )}
            
            {/* Hobbies */}
            {visibleSections.hobbies && hobbies.length > 0 && (
              <section className="bg-gray-50 p-4 rounded-lg">
                <h3 
                  className={`${fontSizeClasses.normal} font-bold mb-2 pb-1 border-b`}
                  style={{ borderColor: colorTheme, color: colorTheme }}
                >
                  INTERESTS
                </h3>
                
                <div className="flex flex-wrap gap-2">
                  {hobbies.map((hobby, index) => (
                    <span 
                      key={index}
                      className={`${fontSizeClasses.normal} px-2 py-1 rounded`}
                      style={{ backgroundColor: `${colorTheme}20`, color: colorTheme }}
                    >
                      {hobby}
                    </span>
                  ))}
                </div>
              </section>
            )}
          </div>
        </div>
        
        {/* Right main content */}
        <div className="col-span-2 space-y-6">
          {/* Professional Summary */}
          {personalInfo.bio && (
            <section>
              <h2 
                className={`${fontSizeClasses.sectionHeading} font-bold mb-3`}
                style={{ color: colorTheme }}
              >
                Professional Summary
              </h2>
              
              <div 
                className="p-4 border-l-4 bg-gray-50"
                style={{ borderColor: colorTheme }}
              >
                <p className={`${fontSizeClasses.normal} text-gray-700 italic`}>
                  "{personalInfo.bio}"
                </p>
              </div>
            </section>
          )}
          
          {/* Experience */}
          {visibleSections.experience && experience.length > 0 && (
            <section>
              <h2 
                className={`${fontSizeClasses.sectionHeading} font-bold mb-4`}
                style={{ color: colorTheme }}
              >
                Experience
              </h2>
              
              <div className="space-y-5">
                {experience.map((exp, index) => (
                  <div 
                    key={exp.id} 
                    className={`relative pl-6 pb-5 ${index < experience.length - 1 ? 'border-l-2' : ''}`}
                    style={{ borderColor: index < experience.length - 1 ? colorTheme : 'transparent' }}
                  >
                    <div 
                      className="absolute left-[-9px] top-0 w-4 h-4 rounded-full border-2 bg-white"
                      style={{ borderColor: colorTheme }}
                    ></div>
                    
                    <div className="flex justify-between items-start">
                      <h3 className={`${fontSizeClasses.normal} font-bold`} style={{ color: colorTheme }}>
                        {exp.position}
                      </h3>
                      <span 
                        className={`${fontSizeClasses.normal} px-2 py-1 rounded text-white`}
                        style={{ backgroundColor: colorTheme }}
                      >
                        {exp.startDate} - {exp.isCurrentPosition ? 'Present' : exp.endDate}
                      </span>
                    </div>
                    
                    <p className={`${fontSizeClasses.normal} font-medium text-gray-700 mt-1`}>
                      {exp.company}
                    </p>
                    
                    <p className={`${fontSizeClasses.normal} text-gray-600 mt-2`}>
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
                className={`${fontSizeClasses.sectionHeading} font-bold mb-4`}
                style={{ color: colorTheme }}
              >
                Projects
              </h2>
              
              <div className="grid grid-cols-2 gap-4">
                {projects.map((project) => (
                  <div 
                    key={project.id} 
                    className="p-4 border rounded-lg transition-all hover:shadow-md"
                    style={{ borderColor: `${colorTheme}40` }}
                  >
                    <div className="flex justify-between items-start mb-2">
                      <h3 
                        className={`${fontSizeClasses.normal} font-bold`}
                        style={{ color: colorTheme }}
                      >
                        {project.title}
                      </h3>
                      
                      {project.link && (
                        <a 
                          href={project.link} 
                          target="_blank" 
                          rel="noopener noreferrer"
                          className={`${fontSizeClasses.normal} text-white px-2 rounded-full text-xs`}
                          style={{ backgroundColor: colorTheme }}
                        >
                          View
                        </a>
                      )}
                    </div>
                    
                    <p className={`${fontSizeClasses.normal} text-gray-600 mb-2`}>
                      {project.description}
                    </p>
                    
                    <p className={`${fontSizeClasses.normal} bg-gray-50 p-2 rounded`}>
                      <strong>Tech:</strong> {project.technologies}
                    </p>
                  </div>
                ))}
              </div>
            </section>
          )}
          
          {/* Certifications */}
          {visibleSections.certifications && certifications.length > 0 && (
            <section>
              <h2 
                className={`${fontSizeClasses.sectionHeading} font-bold mb-3`}
                style={{ color: colorTheme }}
              >
                Certifications
              </h2>
              
              <div className="flex flex-wrap gap-2">
                {certifications.map((cert, index) => (
                  <div 
                    key={index} 
                    className={`${fontSizeClasses.normal} py-1 px-3 rounded-lg border`}
                    style={{ borderColor: colorTheme }}
                  >
                    {cert}
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

export default CreativeTemplate;
