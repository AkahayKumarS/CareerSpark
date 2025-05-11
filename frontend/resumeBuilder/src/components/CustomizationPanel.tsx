import React, { useState } from "react";
import { useResume } from "../contexts/ResumeContext";
import { Tabs, TabsContent, TabsList, TabsTrigger } from "@/components/ui/tabs";
import { Slider } from "@/components/ui/slider";
import { Switch } from "@/components/ui/switch";
import { Button } from "@/components/ui/button";
import {
  Type,
  Palette,
  EyeOff,
  Download,
  RefreshCw,
  CheckSquare,
  PanelLeftClose,
  PanelLeftOpen,
  Bold,
  Italic,
  AlignLeft,
  AlignCenter,
  AlignRight,
  Edit,
} from "lucide-react";
import { Label } from "@/components/ui/label";
import { RadioGroup, RadioGroupItem } from "@/components/ui/radio-group";
import { toast } from "@/components/ui/use-toast";
import PDFDownloader from "./PDFDownloader";
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "./ui/select";
import { Input } from "./ui/input";
import ResumeForm from "./ResumeForm";
import ColorPicker from "./ColorPicker";

interface CustomizationPanelProps {
  isOpen: boolean;
  onToggle: () => void;
}

// Available fonts
const availableFonts = [
  "Roboto",
  "Poppins",
  "Montserrat",
  "Lato",
  "Open Sans",
  "Playfair Display",
  "Merriweather",
  "Source Sans Pro",
  "Ubuntu",
];

const CustomizationPanel = ({ isOpen, onToggle }: CustomizationPanelProps) => {
  const {
    customization,
    setCustomization,
    activeTemplate,
    resetToTemplate,
    setFont,
    setFontSize,
    setColorTheme,
    setSectionVisibility,
  } = useResume();

  const [colorInput, setColorInput] = useState(customization.colorTheme);

  const handleColorChange = (color: string) => {
    setColorTheme(color);
    setColorInput(color);
  };

  const handleColorInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setColorInput(e.target.value);
  };

  const handleColorInputBlur = () => {
    if (/^#([0-9A-F]{3}){1,2}$/i.test(colorInput)) {
      setColorTheme(colorInput);
    } else {
      // Reset to current theme if invalid
      setColorInput(customization.colorTheme);
      toast({
        title: "Invalid color format",
        description: "Please use a valid hex color code (e.g., #FF5733)",
        variant: "destructive",
      });
    }
  };

  const handleReset = () => {
    resetToTemplate();
    toast({
      title: "Reset successful",
      description: "Your resume has been reset to the template defaults",
    });
  };

  return (
    <>
      <div
        className={`fixed top-0 right-0 h-full bg-white shadow-lg transition-transform duration-300 ease-in-out z-30 ${
          isOpen ? "translate-x-0" : "translate-x-full"
        }`}
        style={{ width: "400px" }}
      >
        <div className="p-4 border-b sticky top-0 bg-white z-10 flex justify-between items-center">
          <h2 className="text-lg font-semibold">Customize Resume</h2>
          <Button
            variant="ghost"
            size="icon"
            onClick={onToggle}
            className="h-8 w-8"
          >
            <PanelLeftClose className="h-4 w-4" />
          </Button>
        </div>

        <div
          className="p-4 overflow-y-auto"
          style={{ height: "calc(100vh - 70px)" }}
        >
          <Tabs defaultValue="content">
            <TabsList className="grid grid-cols-4 mb-4">
              <TabsTrigger value="content">
                <Edit className="h-4 w-4 mr-1" />
                <span className="text-xs">Content</span>
              </TabsTrigger>
              <TabsTrigger value="fonts">
                <Type className="h-4 w-4 mr-1" />
                <span className="text-xs">Fonts</span>
              </TabsTrigger>
              <TabsTrigger value="colors">
                <Palette className="h-4 w-4 mr-1" />
                <span className="text-xs">Colors</span>
              </TabsTrigger>
              <TabsTrigger value="sections">
                <CheckSquare className="h-4 w-4 mr-1" />
                <span className="text-xs">Sections</span>
              </TabsTrigger>
            </TabsList>

            <TabsContent value="content">
              <ResumeForm />
            </TabsContent>

            <TabsContent value="fonts" className="space-y-6">
              <div className="space-y-3">
                <h3 className="text-sm font-medium">Font Style</h3>
                <Select value={customization.font} onValueChange={setFont}>
                  <SelectTrigger>
                    <SelectValue placeholder="Select font" />
                  </SelectTrigger>
                  <SelectContent>
                    {availableFonts.map((font) => (
                      <SelectItem key={font} value={font}>
                        <span
                          className={`font-${font
                            .toLowerCase()
                            .replace(/\s+/g, "-")}`}
                        >
                          {font}
                        </span>
                      </SelectItem>
                    ))}
                  </SelectContent>
                </Select>
              </div>

              <div className="space-y-3">
                <div className="flex justify-between">
                  <h3 className="text-sm font-medium">Font Size</h3>
                  <span className="text-xs text-gray-500">
                    {customization.fontSize === "small"
                      ? "Small"
                      : customization.fontSize === "medium"
                      ? "Medium"
                      : "Large"}
                  </span>
                </div>
                <Slider
                  min={0}
                  max={2}
                  step={1}
                  value={[
                    customization.fontSize === "small"
                      ? 0
                      : customization.fontSize === "medium"
                      ? 1
                      : 2,
                  ]}
                  onValueChange={(value) => {
                    const size =
                      value[0] === 0
                        ? "small"
                        : value[0] === 1
                        ? "medium"
                        : "large";
                    setFontSize(size);
                  }}
                />
              </div>

              <div className="space-y-3">
                <h3 className="text-sm font-medium">Text Formatting</h3>
                <div className="flex gap-2">
                  <Button variant="outline" size="sm" className="flex-1">
                    <Bold className="h-4 w-4" />
                  </Button>
                  <Button variant="outline" size="sm" className="flex-1">
                    <Italic className="h-4 w-4" />
                  </Button>
                  <Button variant="outline" size="sm" className="flex-1">
                    <AlignLeft className="h-4 w-4" />
                  </Button>
                  <Button variant="outline" size="sm" className="flex-1">
                    <AlignCenter className="h-4 w-4" />
                  </Button>
                  <Button variant="outline" size="sm" className="flex-1">
                    <AlignRight className="h-4 w-4" />
                  </Button>
                </div>
              </div>
            </TabsContent>

            <TabsContent value="colors" className="space-y-6">
              <div className="space-y-3">
                <h3 className="text-sm font-medium">Color Theme</h3>
                <div className="grid grid-cols-5 gap-2 mb-3">
                  {activeTemplate.colors.map((color) => (
                    <button
                      key={color}
                      className={`w-full aspect-square rounded-full border-2 ${
                        customization.colorTheme === color
                          ? "border-black"
                          : "border-transparent"
                      }`}
                      style={{ backgroundColor: color }}
                      onClick={() => handleColorChange(color)}
                      aria-label={`Color ${color}`}
                    />
                  ))}
                </div>
                <ColorPicker onPick={handleColorChange} />

                <div className="space-y-2">
                  <Label htmlFor="custom-color">Custom Color</Label>
                  <div className="flex gap-2">
                    <div
                      className="h-10 w-10 rounded-md border"
                      style={{ backgroundColor: colorInput }}
                    />
                    <Input
                      id="custom-color"
                      type="text"
                      value={colorInput}
                      onChange={handleColorInputChange}
                      onBlur={handleColorInputBlur}
                      placeholder="#HEX color"
                      className="flex-1"
                    />
                  </div>
                </div>
              </div>
            </TabsContent>

            <TabsContent value="sections" className="space-y-4">
              <h3 className="text-sm font-medium">Toggle Sections</h3>

              {Object.entries(customization.visibleSections).map(
                ([section, isVisible]) => (
                  <div
                    key={section}
                    className="flex items-center justify-between"
                  >
                    <Label
                      htmlFor={`section-${section}`}
                      className="capitalize"
                    >
                      {section}
                    </Label>
                    <Switch
                      id={`section-${section}`}
                      checked={isVisible}
                      onCheckedChange={(checked) =>
                        setSectionVisibility(
                          section as keyof typeof customization.visibleSections,
                          checked
                        )
                      }
                    />
                  </div>
                )
              )}
            </TabsContent>
          </Tabs>

          <div className="mt-8 pt-6 border-t grid grid-cols-2 gap-3">
            <Button variant="outline" className="w-full" onClick={handleReset}>
              <RefreshCw className="h-4 w-4 mr-1" />
              Reset
            </Button>
            <PDFDownloader />
          </div>
        </div>
      </div>

      {!isOpen && (
        <Button
          variant="outline"
          size="icon"
          className="fixed top-4 right-4 z-20 bg-white shadow-md hover:bg-resume-teal hover:text-white"
          onClick={onToggle}
        >
          <PanelLeftOpen className="h-4 w-4" />
        </Button>
      )}
    </>
  );
};

export default CustomizationPanel;
