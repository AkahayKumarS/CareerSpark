
import React from 'react';
import { useResume } from '../../contexts/ResumeContext';
import { Phone, Mail, MapPin, Linkedin, Globe, Github } from 'lucide-react';

const ModernTemplate = () => {
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
      className={`w-full h-full bg-white p-0 font-${font.toLowerCase()} resume-preview flex`}
      style={{ fontSize: fontSize === 'small' ? '14px' : fontSize === 'medium' ? '16px' : '18px' }}
    >
      {/* Sidebar */}
      <div 
        className="w-1/3 p-6 text-white"
        style={{ backgroundColor: colorTheme }}
      >
        <div className="mb-8 flex flex-col items-center">
          {personalInfo.profileImage ? (
            <img 
              src={personalInfo.profileImage} 
              alt={personalInfo.fullName}
              className="w-32 h-32 rounded-full border-4 border-white mb-4 object-cover"
            />
          ) : (
            <div 
              className="w-32 h-32 rounded-full border-4 border-white mb-4 flex items-center justify-center bg-white/20 text-white"
            >
              <span className="text-3xl font-bold">
                {personalInfo.fullName.split(' ').map(name => name[0]).join('')}
              </span>
            </div>
          )}
          <h1 className={`${fontSizeClasses.name} font-bold text-center`}>
            {personalInfo.fullName}
          </h1>
          <h2 className={`${fontSizeClasses.title} font-medium text-center opacity-90 mb-4`}>
            {personalInfo.title}
          </h2>
        </div>

        {/* Contact Information */}
        <div className="mb-8 space-y-3">
          <h3 className={`${fontSizeClasses.sectionHeading} font-bold border-b border-white/30 pb-2 mb-3`}>
            Contact
          </h3>
          {personalInfo.phone && (
            <div className="flex items-center">
              <Phone className="h-4 w-4 mr-3" />
              <span className={`${fontSizeClasses.normal}`}>{personalInfo.phone}</span>
            </div>
          )}
          {personalInfo.email && (
            <div className="flex items-center">
              <Mail className="h-4 w-4 mr-3" />
              <span className={`${fontSizeClasses.normal}`}>{personalInfo.email}</span>
            </div>
          )}
          {personalInfo.address && (
            <div className="flex items-center">
              <MapPin className="h-4 w-4 mr-3" />
              <span className={`${fontSizeClasses.normal}`}>{personalInfo.address}</span>
            </div>
          )}
          {personalInfo.linkedin && (
            <div className="flex items-center">
              <Linkedin className="h-4 w-4 mr-3" />
              <span className={`${fontSizeClasses.normal}`}>{personalInfo.linkedin}</span>
            </div>
          )}
          {personalInfo.website && (
            <div className="flex items-center">
              <Globe className="h-4 w-4 mr-3" />
              <span className={`${fontSizeClasses.normal}`}>{personalInfo.website}</span>
            </div>
          )}
          {personalInfo.github && (
            <div className="flex items-center">
              <Github className="h-4 w-4 mr-3" />
              <span className={`${fontSizeClasses.normal}`}>{personalInfo.github}</span>
            </div>
          )}
        </div>

        {/* Skills */}
        {visibleSections.skills && skills.length > 0 && (
          <div className="mb-8">
            <h3 className={`${fontSizeClasses.sectionHeading} font-bold border-b border-white/30 pb-2 mb-3`}>
              Skills
            </h3>
            <div className="space-y-3">
              {skills.map((skill) => (
                <div key={skill.id}>
                  <div className="flex justify-between mb-1">
                    <span className={`${fontSizeClasses.normal} font-medium`}>{skill.name}</span>
                    <span className={`${fontSizeClasses.normal} opacity-80`}>{skill.level}%</span>
                  </div>
                  <div className="w-full bg-white/20 rounded-full h-2">
                    <div className="h-2 rounded-full bg-white" style={{ width: `${skill.level}%` }}></div>
                  </div>
                </div>
              ))}
            </div>
          </div>
        )}

        {/* Languages */}
        {visibleSections.languages && languages.length > 0 && (
          <div className="mb-8">
            <h3 className={`${fontSizeClasses.sectionHeading} font-bold border-b border-white/30 pb-2 mb-3`}>
              Languages
            </h3>
            <ul className="space-y-1">
              {languages.map((language, index) => (
                <li key={index} className={`${fontSizeClasses.normal}`}>{language}</li>
              ))}
            </ul>
          </div>
        )}

        {/* Hobbies */}
        {visibleSections.hobbies && hobbies.length > 0 && (
          <div>
            <h3 className={`${fontSizeClasses.sectionHeading} font-bold border-b border-white/30 pb-2 mb-3`}>
              Hobbies
            </h3>
            <div className="flex flex-wrap gap-2">
              {hobbies.map((hobby, index) => (
                <span 
                  key={index}
                  className={`${fontSizeClasses.normal} px-3 py-1 rounded-full bg-white/20`}
                >
                  {hobby}
                </span>
              ))}
            </div>
          </div>
        )}
      </div>

      {/* Main Content */}
      <div className="w-2/3 p-6 text-gray-800">
        {/* Bio */}
        {personalInfo.bio && (
          <section className="mb-6">
            <h3 className={`${fontSizeClasses.sectionHeading} font-bold mb-3`} style={{ color: colorTheme }}>
              Professional Summary
            </h3>
            <p className={`${fontSizeClasses.normal} text-gray-700`}>
              {personalInfo.bio}
            </p>
          </section>
        )}

        {/* Experience */}
        {visibleSections.experience && experience.length > 0 && (
          <section className="mb-6">
            <h3 className={`${fontSizeClasses.sectionHeading} font-bold mb-3`} style={{ color: colorTheme }}>
              Work Experience
            </h3>
            <div className="space-y-4">
              {experience.map((exp) => (
                <div key={exp.id} className="relative pl-6 pb-4 border-l-2" style={{ borderColor: colorTheme }}>
                  <div className="absolute left-[-8px] top-0 w-4 h-4 rounded-full" style={{ backgroundColor: colorTheme }}></div>
                  <div className="mb-1">
                    <h4 className={`${fontSizeClasses.normal} font-bold`}>{exp.position}</h4>
                    <div className="flex justify-between">
                      <span className={`${fontSizeClasses.normal} text-gray-700`}>{exp.company}</span>
                      <span className={`${fontSizeClasses.normal} text-gray-500`}>
                        {exp.startDate} - {exp.isCurrentPosition ? 'Present' : exp.endDate}
                      </span>
                    </div>
                  </div>
                  <p className={`${fontSizeClasses.normal} text-gray-600 mt-1`}>{exp.description}</p>
                </div>
              ))}
            </div>
          </section>
        )}

        {/* Education */}
        {visibleSections.education && education.length > 0 && (
          <section className="mb-6">
            <h3 className={`${fontSizeClasses.sectionHeading} font-bold mb-3`} style={{ color: colorTheme }}>
              Education
            </h3>
            <div className="space-y-4">
              {education.map((edu) => (
                <div key={edu.id} className="relative pl-6 pb-4 border-l-2" style={{ borderColor: colorTheme }}>
                  <div className="absolute left-[-8px] top-0 w-4 h-4 rounded-full" style={{ backgroundColor: colorTheme }}></div>
                  <div className="mb-1">
                    <h4 className={`${fontSizeClasses.normal} font-bold`}>{edu.degree} in {edu.fieldOfStudy}</h4>
                    <div className="flex justify-between">
                      <span className={`${fontSizeClasses.normal} text-gray-700`}>{edu.institution}</span>
                      <span className={`${fontSizeClasses.normal} text-gray-500`}>
                        {edu.startDate} - {edu.endDate}
                      </span>
                    </div>
                  </div>
                  {edu.description && (
                    <p className={`${fontSizeClasses.normal} text-gray-600 mt-1`}>{edu.description}</p>
                  )}
                </div>
              ))}
            </div>
          </section>
        )}

        {/* Projects */}
        {visibleSections.projects && projects.length > 0 && (
          <section className="mb-6">
            <h3 className={`${fontSizeClasses.sectionHeading} font-bold mb-3`} style={{ color: colorTheme }}>
              Projects
            </h3>
            <div className="space-y-4">
              {projects.map((project) => (
                <div key={project.id} className="border-b pb-4 last:border-0">
                  <div className="flex justify-between items-start">
                    <h4 className={`${fontSizeClasses.normal} font-bold`}>{project.title}</h4>
                    {project.link && (
                      <a 
                        href={project.link} 
                        className={`${fontSizeClasses.normal} underline`}
                        style={{ color: colorTheme }}
                        target="_blank"
                        rel="noopener noreferrer"
                      >
                        View Project
                      </a>
                    )}
                  </div>
                  <p className={`${fontSizeClasses.normal} text-gray-700 mt-1`}>{project.description}</p>
                  <p className={`${fontSizeClasses.normal} mt-1`}>
                    <span className="font-medium">Technologies:</span> {project.technologies}
                  </p>
                </div>
              ))}
            </div>
          </section>
        )}

        {/* Certifications */}
        {visibleSections.certifications && certifications.length > 0 && (
          <section>
            <h3 className={`${fontSizeClasses.sectionHeading} font-bold mb-3`} style={{ color: colorTheme }}>
              Certifications
            </h3>
            <ul className="list-disc pl-5 space-y-1">
              {certifications.map((cert, index) => (
                <li key={index} className={`${fontSizeClasses.normal}`}>{cert}</li>
              ))}
            </ul>
          </section>
        )}
      </div>
    </div>
  );
};

export default ModernTemplate;
