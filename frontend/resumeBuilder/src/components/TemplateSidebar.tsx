
import React from 'react';
import { useResume } from '../contexts/ResumeContext';
import TemplateThumbnail from './TemplateThumbnail';
import { Button } from '@/components/ui/button';
import { ChevronLeft, ChevronRight } from 'lucide-react';
import { ScrollArea } from './ui/scroll-area';

interface TemplateSidebarProps {
  isOpen: boolean;
  onToggle: () => void;
}

const TemplateSidebar = ({ isOpen, onToggle }: TemplateSidebarProps) => {
  const { templates, activeTemplate, changeTemplate } = useResume();

  return (
    <>
      <div
        className={`fixed top-0 left-0 h-full bg-white shadow-lg transition-transform duration-300 ease-in-out z-30 ${
          isOpen ? 'translate-x-0' : '-translate-x-full'
        }`}
        style={{ width: '280px' }}
      >
        <div className="p-4 border-b sticky top-0 bg-white z-10 flex justify-between items-center">
          <h2 className="text-lg font-semibold">Resume Templates</h2>
          <Button
            variant="ghost"
            size="icon"
            onClick={onToggle}
            className="h-8 w-8"
          >
            <ChevronLeft className="h-4 w-4" />
          </Button>
        </div>

        <ScrollArea className="h-[calc(100vh-64px)] p-4">
          <div className="grid gap-4">
            {templates.map(template => (
              <TemplateThumbnail
                key={template.id}
                template={template}
                isActive={template.id === activeTemplate.id}
                onSelect={() => {
                  changeTemplate(template.id);
                  // If on mobile, close the sidebar after selection
                  if (window.innerWidth < 768) {
                    onToggle();
                  }
                }}
              />
            ))}
          </div>
        </ScrollArea>
      </div>

      {!isOpen && (
        <Button
          variant="outline"
          size="icon"
          className="fixed top-4 left-4 z-20 bg-white shadow-md hover:bg-resume-teal hover:text-white"
          onClick={onToggle}
        >
          <ChevronRight className="h-4 w-4" />
        </Button>
      )}
    </>
  );
};

export default TemplateSidebar;
