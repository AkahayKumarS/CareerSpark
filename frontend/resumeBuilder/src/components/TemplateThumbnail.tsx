
import React from 'react';
import { Template } from '../contexts/ResumeContext';
import { cn } from '@/lib/utils';
import { Button } from '@/components/ui/button';

interface TemplateThumbnailProps {
  template: Template;
  isActive: boolean;
  onSelect: () => void;
}

const TemplateThumbnail = ({ template, isActive, onSelect }: TemplateThumbnailProps) => {
  const placeholderImage = `https://via.placeholder.com/200x280/f0fbfc/1a97a3?text=${template.name}`;
  
  return (
    <div 
      className={cn(
        "template-card rounded-lg overflow-hidden shadow hover:shadow-lg mb-4 cursor-pointer",
        isActive && "active-template"
      )}
      onClick={onSelect}
    >
      <div className="relative h-60">
        <img 
          src={template.thumbnail || placeholderImage} 
          alt={template.name}
          className="w-full h-full object-cover"
          onError={(e) => {
            // Fallback if the image fails to load
            const target = e.target as HTMLImageElement;
            target.src = placeholderImage;
          }}
        />
        {isActive && (
          <div className="absolute top-2 right-2 bg-resume-teal rounded-full p-1">
            <svg xmlns="http://www.w3.org/2000/svg" className="h-4 w-4 text-white" viewBox="0 0 20 20" fill="currentColor">
              <path fillRule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clipRule="evenodd" />
            </svg>
          </div>
        )}
      </div>
      <div className="p-3 bg-white">
        <h3 className="text-sm font-medium text-gray-800 mb-1">{template.name}</h3>
        <Button 
          variant="outline" 
          size="sm" 
          className={cn(
            "w-full text-xs",
            isActive ? "bg-resume-teal text-white hover:bg-resume-teal-dark" : ""
          )}
          onClick={onSelect}
        >
          {isActive ? 'Selected' : 'Use Template'}
        </Button>
      </div>
    </div>
  );
};

export default TemplateThumbnail;
