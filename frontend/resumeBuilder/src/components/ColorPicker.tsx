import React, { useState } from 'react';

const ColorPicker = ({ onPick }) => {
  const [selectedColor, setSelectedColor] = useState('#000000');
  const [history, setHistory] = useState([]);
  const [pendingColor, setPendingColor] = useState(null); // Track the selected preview color

  const handleColorChange = (e) => {
    const newColor = e.target.value;
    setSelectedColor(newColor);
    onPick?.(newColor);

    // Set the preview color if it is not already in the pending color
    if (newColor !== selectedColor && !history.includes(newColor)) {
      setPendingColor(newColor);
    }
  };

  const handleConfirmColor = () => {
    // Add the selected color to the history if it's not already there
    if (pendingColor && !history.includes(pendingColor)) {
      setHistory([pendingColor, ...history.slice(0, 9)]); // Keep the history max to 10 colors
    }
    setPendingColor(null); // Clear the preview color after confirming
  };

  const handleDeleteColor = (color) => {
    setHistory(history.filter((c) => c !== color));
  };

  const handleClearHistory = () => {
    setHistory([]);
  };

  return (
    <div className="p-4 bg-white dark:bg-gray-800 shadow-md rounded-xl">
      {/* Color Picker */}
      <div className="flex items-center gap-4">
        <input
          type="color"
          value={selectedColor}
          onChange={handleColorChange}
          className="w-12 h-12 rounded-full border cursor-pointer"
        />
        <div className="text-sm text-gray-700 dark:text-gray-300 rounded-xl">
          Selected: <span style={{ color: selectedColor }}>{selectedColor}</span>
        </div>
      </div>

      {/* Add to history button */}
      {pendingColor && (
        <button
          onClick={handleConfirmColor}
          className="mt-2 px-3 py-1 text-sm bg-green-600 text-white rounded hover:bg-green-700"
        >
          Add
        </button>
      )}

      {/* History section */}
      {history.length > 0 && (
        <div className="mt-6">
          <div className="flex justify-between items-center mb-2">
            <h3 className="text-sm font-medium text-gray-800 dark:text-gray-200">Recent Colors</h3>
            <button
              onClick={handleClearHistory}
              className="text-xs text-red-500 hover:text-red-700"
            >
              Clear All
            </button>
          </div>

          <div className="grid grid-cols-5 gap-2">
            {history.map((color, index) => (
              <div key={index} className="relative">
                <button
                  className="w-8 h-8 rounded-full border border-gray-300" // Changed to 'rounded-full' for round button
                  style={{ backgroundColor: color }}
                  onClick={() => {
                    setSelectedColor(color);
                    onPick?.(color);
                  }}
                />
                <button
                  onClick={() => handleDeleteColor(color)}
                  className="absolute -top-1 -right-1 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-full w-4 h-4 text-xs text-red-500 hover:text-red-700 flex items-center justify-center"
                >
                  ×
                </button>
              </div>
            ))}
          </div>
        </div>
      )}
    </div>
  );
};

export default ColorPicker;
