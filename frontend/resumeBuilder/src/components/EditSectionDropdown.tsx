
import React from 'react';
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuLabel,
  DropdownMenuSeparator,
  DropdownMenuTrigger
} from '@/components/ui/dropdown-menu';
import { Edit, Trash, Plus, Eye, EyeOff } from 'lucide-react';
import { Button } from './ui/button';
import { useResume } from '../contexts/ResumeContext';

type EditSectionDropdownProps = {
  sectionType: 'education' | 'experience' | 'skills' | 'projects';
  itemId?: string;
  onEdit?: () => void;
  onDelete?: () => void;
  onAdd?: () => void;
  label?: string;
};

const EditSectionDropdown = ({ 
  sectionType, 
  itemId, 
  onEdit, 
  onDelete, 
  onAdd, 
  label = 'Actions' 
}: EditSectionDropdownProps) => {
  const { setSectionVisibility, customization } = useResume();
  const { visibleSections } = customization;
  const isVisible = visibleSections[sectionType];

  const handleToggleVisibility = () => {
    setSectionVisibility(sectionType, !isVisible);
  };

  return (
    <DropdownMenu>
      <DropdownMenuTrigger asChild>
        <Button 
          variant="ghost" 
          size="sm" 
          className="h-8 w-8 p-0 rounded-full"
        >
          <span className="sr-only">Open menu</span>
          <Edit className="h-4 w-4" />
        </Button>
      </DropdownMenuTrigger>
      <DropdownMenuContent align="end" className="w-[160px]">
        <DropdownMenuLabel>{label}</DropdownMenuLabel>
        <DropdownMenuSeparator />
        
        {onEdit && itemId && (
          <DropdownMenuItem onClick={onEdit} className="cursor-pointer">
            <Edit className="mr-2 h-4 w-4" />
            <span>Edit</span>
          </DropdownMenuItem>
        )}
        
        {onDelete && itemId && (
          <DropdownMenuItem onClick={onDelete} className="cursor-pointer text-red-600">
            <Trash className="mr-2 h-4 w-4" />
            <span>Delete</span>
          </DropdownMenuItem>
        )}
        
        {onAdd && (
          <DropdownMenuItem onClick={onAdd} className="cursor-pointer">
            <Plus className="mr-2 h-4 w-4" />
            <span>Add New</span>
          </DropdownMenuItem>
        )}

        <DropdownMenuItem onClick={handleToggleVisibility} className="cursor-pointer">
          {isVisible ? (
            <>
              <EyeOff className="mr-2 h-4 w-4" />
              <span>Hide Section</span>
            </>
          ) : (
            <>
              <Eye className="mr-2 h-4 w-4" />
              <span>Show Section</span>
            </>
          )}
        </DropdownMenuItem>
      </DropdownMenuContent>
    </DropdownMenu>
  );
};

export default EditSectionDropdown;
