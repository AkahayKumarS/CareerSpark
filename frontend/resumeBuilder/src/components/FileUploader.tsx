
import React, { useState } from 'react';
import { useResume, ResumeData } from '../contexts/ResumeContext';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Upload, FileWarning, CheckCircle, AlertCircle } from 'lucide-react';
import { toast } from '@/components/ui/use-toast';

const FileUploader = () => {
  const { uploadResumeData } = useResume();
  const [isUploading, setIsUploading] = useState(false);
  const [error, setError] = useState<string | null>(null);

  const handleFileUpload = (event: React.ChangeEvent<HTMLInputElement>) => {
    const file = event.target.files?.[0];
    if (!file) return;

    // Check file type
    if (!file.name.endsWith('.json') && !file.name.endsWith('.csv')) {
      toast({
        title: "Invalid file type",
        description: "Please upload a JSON or CSV file",
        variant: "destructive"
      });
      return;
    }

    // Check file size (2MB max)
    if (file.size > 2 * 1024 * 1024) {
      toast({
        title: "File too large",
        description: "Maximum file size is 2MB",
        variant: "destructive"
      });
      return;
    }

    setIsUploading(true);
    setError(null);

    const reader = new FileReader();

    reader.onload = (e) => {
      try {
        const content = e.target?.result as string;
        let data: Partial<ResumeData>;

        if (file.name.endsWith('.json')) {
          data = JSON.parse(content);
        } else {
          // Simple CSV parsing (in a real app, use a proper CSV parser)
          data = parseCSV(content);
        }

        // Validate the structure
        validateResumeData(data);

        // Upload the data
        uploadResumeData(data);

        toast({
          title: "File uploaded successfully",
          description: "Your resume data has been loaded",
          variant: "default"
        });
      } catch (error) {
        console.error('Error parsing file:', error);
        setError((error as Error).message);
        toast({
          title: "Error parsing file",
          description: (error as Error).message,
          variant: "destructive"
        });
      } finally {
        setIsUploading(false);
      }
    };

    reader.onerror = () => {
      setError('Error reading file');
      setIsUploading(false);
      toast({
        title: "Error reading file",
        description: "There was an error reading your file",
        variant: "destructive"
      });
    };

    reader.readAsText(file);
  };

  // Simple CSV parsing (in a real app, use a proper CSV parser)
  const parseCSV = (content: string): Partial<ResumeData> => {
    // This is a simplified implementation. A real app would need a more robust CSV parser.
    const lines = content.split('\n');
    const headers = lines[0].split(',');
    
    // This is just a placeholder - real implementation would be more complex
    throw new Error('CSV parsing is not fully implemented in this demo');
  };

  // Validate resume data structure
  const validateResumeData = (data: any) => {
    if (!data) {
      throw new Error('Invalid data format');
    }

    // Basic validation - in a real app, this would be more comprehensive
    if (data.personalInfo && typeof data.personalInfo !== 'object') {
      throw new Error('Invalid personal info format');
    }

    if (data.education && !Array.isArray(data.education)) {
      throw new Error('Education must be an array');
    }

    if (data.experience && !Array.isArray(data.experience)) {
      throw new Error('Experience must be an array');
    }

    if (data.skills && !Array.isArray(data.skills)) {
      throw new Error('Skills must be an array');
    }

    if (data.projects && !Array.isArray(data.projects)) {
      throw new Error('Projects must be an array');
    }
  };

  return (
    <div className="mt-6">
      <div className="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
        <Input
          type="file"
          accept=".json,.csv"
          onChange={handleFileUpload}
          className="hidden"
          id="file-upload"
          disabled={isUploading}
        />
        <label 
          htmlFor="file-upload" 
          className="cursor-pointer flex flex-col items-center justify-center"
        >
          {isUploading ? (
            <div className="animate-pulse">
              <div className="flex flex-col items-center">
                <Upload className="h-12 w-12 text-resume-teal mb-2" />
                <p className="text-sm font-medium mb-1">Uploading...</p>
                <p className="text-xs text-gray-500">Please wait</p>
              </div>
            </div>
          ) : error ? (
            <div className="text-red-500">
              <FileWarning className="h-12 w-12 mx-auto mb-2" />
              <p className="text-sm font-medium mb-1">Error uploading file</p>
              <p className="text-xs">{error}</p>
              <Button 
                variant="outline" 
                size="sm" 
                className="mt-2"
                onClick={() => setError(null)}
              >
                Try again
              </Button>
            </div>
          ) : (
            <>
              <Upload className="h-12 w-12 text-resume-teal mb-2" />
              <p className="text-sm font-medium mb-1">Click to upload your resume data</p>
              <p className="text-xs text-gray-500">JSON or CSV (Max 2MB)</p>
            </>
          )}
        </label>
      </div>

      <div className="mt-4">
        <h4 className="text-sm font-medium mb-2">Supported formats:</h4>
        <ul className="text-xs text-gray-600 space-y-1">
          <li className="flex items-center">
            <CheckCircle className="h-3 w-3 text-green-500 mr-1" /> 
            JSON: Complete resume data format
          </li>
          <li className="flex items-center">
            <AlertCircle className="h-3 w-3 text-amber-500 mr-1" /> 
            CSV: Basic information only (demo purposes)
          </li>
        </ul>
      </div>
    </div>
  );
};

export default FileUploader;
