import React from 'react';
import { useResume } from '../contexts/ResumeContext';
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Textarea } from "@/components/ui/textarea";
import { Button } from "@/components/ui/button";
import { Plus, Trash2, ImagePlus } from 'lucide-react';
import { toast } from '@/components/ui/use-toast';

const ResumeForm = () => {
  const { 
    resumeData, 
    updatePersonalInfo,
    addEducation,
    updateEducation,
    removeEducation,
    addExperience,
    updateExperience,
    removeExperience,
    addSkill,
    updateSkill,
    removeSkill,
    addProject,
    updateProject,
    removeProject
  } = useResume();

  const handleImageUpload = (event: React.ChangeEvent<HTMLInputElement>) => {
    const file = event.target.files?.[0];
    if (file) {
      if (file.size > 5 * 1024 * 1024) { // 5MB limit
        toast({
          title: "File too large",
          description: "Please upload an image smaller than 5MB",
          variant: "destructive",
        });
        return;
      }

      const reader = new FileReader();
      reader.onloadend = () => {
        updatePersonalInfo({ profileImage: reader.result as string });
      };
      reader.readAsDataURL(file);
    }
  };

  return (
    <div className="space-y-6">
      {/* Personal Info Section */}
      <div className="space-y-4">
        <h3 className="text-lg font-semibold">Personal Information</h3>
        <div className="grid gap-3">
          <div>
            <Label htmlFor="profileImage">Profile Image</Label>
            <div className="flex items-center gap-4 mt-1">
              {resumeData.personalInfo.profileImage && (
                <img 
                  src={resumeData.personalInfo.profileImage} 
                  alt="Profile" 
                  className="w-16 h-16 rounded-full object-cover"
                />
              )}
              <div className="flex-1">
                <Input
                  id="profileImage"
                  type="file"
                  accept="image/*"
                  onChange={handleImageUpload}
                  className="cursor-pointer"
                />
              </div>
              {resumeData.personalInfo.profileImage && (
                <Button
                  variant="destructive"
                  size="sm"
                  onClick={() => updatePersonalInfo({ profileImage: null })}
                >
                  <Trash2 className="h-4 w-4" />
                </Button>
              )}
            </div>
          </div>

          <div>
            <Label htmlFor="fullName">Full Name</Label>
            <Input
              id="fullName"
              value={resumeData.personalInfo.fullName}
              onChange={(e) => updatePersonalInfo({ fullName: e.target.value })}
            />
          </div>
          <div>
            <Label htmlFor="title">Professional Title</Label>
            <Input
              id="title"
              value={resumeData.personalInfo.title}
              onChange={(e) => updatePersonalInfo({ title: e.target.value })}
            />
          </div>
          <div>
            <Label htmlFor="email">Email</Label>
            <Input
              id="email"
              type="email"
              value={resumeData.personalInfo.email}
              onChange={(e) => updatePersonalInfo({ email: e.target.value })}
            />
          </div>
          <div>
            <Label htmlFor="phone">Phone</Label>
            <Input
              id="phone"
              value={resumeData.personalInfo.phone}
              onChange={(e) => updatePersonalInfo({ phone: e.target.value })}
            />
          </div>
          <div>
            <Label htmlFor="address">Address</Label>
            <Input
              id="address"
              value={resumeData.personalInfo.address}
              onChange={(e) => updatePersonalInfo({ address: e.target.value })}
            />
          </div>
          <div>
            <Label htmlFor="linkedin">LinkedIn</Label>
            <Input
              id="linkedin"
              value={resumeData.personalInfo.linkedin}
              onChange={(e) => updatePersonalInfo({ linkedin: e.target.value })}
            />
          </div>
          <div>
            <Label htmlFor="github">GitHub</Label>
            <Input
              id="github"
              value={resumeData.personalInfo.github}
              onChange={(e) => updatePersonalInfo({ github: e.target.value })}
            />
          </div>
          <div>
            <Label htmlFor="website">Website</Label>
            <Input
              id="website"
              value={resumeData.personalInfo.website}
              onChange={(e) => updatePersonalInfo({ website: e.target.value })}
            />
          </div>
          <div>
            <Label htmlFor="bio">Professional Summary</Label>
            <Textarea
              id="bio"
              value={resumeData.personalInfo.bio}
              onChange={(e) => updatePersonalInfo({ bio: e.target.value })}
            />
          </div>
        </div>
      </div>

      {/* Education Section */}
      <div className="space-y-4">
        <div className="flex justify-between items-center">
          <h3 className="text-lg font-semibold">Education</h3>
          <Button 
            variant="outline" 
            size="sm"
            onClick={() => addEducation({
              institution: "",
              degree: "",
              fieldOfStudy: "",
              startDate: "",
              endDate: "",
              description: "",
            })}
          >
            <Plus className="h-4 w-4 mr-1" />
            Add Education
          </Button>
        </div>
        {resumeData.education.map((edu) => (
          <div key={edu.id} className="border p-4 rounded-md space-y-3">
            <div className="grid gap-3">
              <div>
                <Label>Institution</Label>
                <Input
                  value={edu.institution}
                  onChange={(e) => updateEducation(edu.id, { institution: e.target.value })}
                />
              </div>
              <div>
                <Label>Degree</Label>
                <Input
                  value={edu.degree}
                  onChange={(e) => updateEducation(edu.id, { degree: e.target.value })}
                />
              </div>
              <div>
                <Label>Field of Study</Label>
                <Input
                  value={edu.fieldOfStudy}
                  onChange={(e) => updateEducation(edu.id, { fieldOfStudy: e.target.value })}
                />
              </div>
              <div className="grid grid-cols-2 gap-3">
                <div>
                  <Label>Start Date</Label>
                  <Input
                    type="month"
                    value={edu.startDate}
                    onChange={(e) => updateEducation(edu.id, { startDate: e.target.value })}
                  />
                </div>
                <div>
                  <Label>End Date</Label>
                  <Input
                    type="month"
                    value={edu.endDate}
                    onChange={(e) => updateEducation(edu.id, { endDate: e.target.value })}
                  />
                </div>
              </div>
              <div>
                <Label>Description</Label>
                <Textarea
                  value={edu.description}
                  onChange={(e) => updateEducation(edu.id, { description: e.target.value })}
                />
              </div>
            </div>
            <Button 
              variant="destructive" 
              size="sm"
              onClick={() => removeEducation(edu.id)}
            >
              <Trash2 className="h-4 w-4 mr-1" />
              Remove
            </Button>
          </div>
        ))}
      </div>

      {/* Experience Section */}
      <div className="space-y-4">
        <div className="flex justify-between items-center">
          <h3 className="text-lg font-semibold">Experience</h3>
          <Button 
            variant="outline" 
            size="sm"
            onClick={() => addExperience({
              company: "",
              position: "",
              startDate: "",
              endDate: "",
              description: "",
              isCurrentPosition: false,
            })}
          >
            <Plus className="h-4 w-4 mr-1" />
            Add Experience
          </Button>
        </div>
        {resumeData.experience.map((exp) => (
          <div key={exp.id} className="border p-4 rounded-md space-y-3">
            <div className="grid gap-3">
              <div>
                <Label>Company</Label>
                <Input
                  value={exp.company}
                  onChange={(e) => updateExperience(exp.id, { company: e.target.value })}
                />
              </div>
              <div>
                <Label>Position</Label>
                <Input
                  value={exp.position}
                  onChange={(e) => updateExperience(exp.id, { position: e.target.value })}
                />
              </div>
              <div className="grid grid-cols-2 gap-3">
                <div>
                  <Label>Start Date</Label>
                  <Input
                    type="month"
                    value={exp.startDate}
                    onChange={(e) => updateExperience(exp.id, { startDate: e.target.value })}
                  />
                </div>
                <div>
                  <Label>End Date</Label>
                  <Input
                    type="month"
                    value={exp.endDate}
                    onChange={(e) => updateExperience(exp.id, { endDate: e.target.value })}
                    disabled={exp.isCurrentPosition}
                  />
                </div>
              </div>
              <div>
                <Label>Description</Label>
                <Textarea
                  value={exp.description}
                  onChange={(e) => updateExperience(exp.id, { description: e.target.value })}
                />
              </div>
            </div>
            <Button 
              variant="destructive" 
              size="sm"
              onClick={() => removeExperience(exp.id)}
            >
              <Trash2 className="h-4 w-4 mr-1" />
              Remove
            </Button>
          </div>
        ))}
      </div>

      {/* Skills Section */}
      <div className="space-y-4">
        <div className="flex justify-between items-center">
          <h3 className="text-lg font-semibold">Skills</h3>
          <Button 
            variant="outline" 
            size="sm"
            onClick={() => addSkill({ name: "", level: 50 })}
          >
            <Plus className="h-4 w-4 mr-1" />
            Add Skill
          </Button>
        </div>
        <div className="grid gap-3">
          {resumeData.skills.map((skill) => (
            <div key={skill.id} className="flex items-center gap-3">
              <Input
                value={skill.name}
                onChange={(e) => updateSkill(skill.id, { name: e.target.value })}
                className="flex-1"
                placeholder="Skill name"
              />
              <Input
                type="number"
                min="0"
                max="100"
                value={skill.level}
                onChange={(e) => updateSkill(skill.id, { level: parseInt(e.target.value) })}
                className="w-20"
              />
              <Button 
                variant="destructive" 
                size="icon"
                onClick={() => removeSkill(skill.id)}
              >
                <Trash2 className="h-4 w-4" />
              </Button>
            </div>
          ))}
        </div>
      </div>

      {/* Projects Section */}
      <div className="space-y-4">
        <div className="flex justify-between items-center">
          <h3 className="text-lg font-semibold">Projects</h3>
          <Button 
            variant="outline" 
            size="sm"
            onClick={() => addProject({
              title: "",
              description: "",
              technologies: "",
              link: "",
            })}
          >
            <Plus className="h-4 w-4 mr-1" />
            Add Project
          </Button>
        </div>
        {resumeData.projects.map((project) => (
          <div key={project.id} className="border p-4 rounded-md space-y-3">
            <div className="grid gap-3">
              <div>
                <Label>Title</Label>
                <Input
                  value={project.title}
                  onChange={(e) => updateProject(project.id, { title: e.target.value })}
                />
              </div>
              <div>
                <Label>Description</Label>
                <Textarea
                  value={project.description}
                  onChange={(e) => updateProject(project.id, { description: e.target.value })}
                />
              </div>
              <div>
                <Label>Technologies</Label>
                <Input
                  value={project.technologies}
                  onChange={(e) => updateProject(project.id, { technologies: e.target.value })}
                />
              </div>
              <div>
                <Label>Link</Label>
                <Input
                  value={project.link}
                  onChange={(e) => updateProject(project.id, { link: e.target.value })}
                />
              </div>
            </div>
            <Button 
              variant="destructive" 
              size="sm"
              onClick={() => removeProject(project.id)}
            >
              <Trash2 className="h-4 w-4 mr-1" />
              Remove
            </Button>
          </div>
        ))}
      </div>
    </div>
  );
};

export default ResumeForm;
