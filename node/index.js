import { writeFile } from 'fs';

// Define the content to write to the file
const content = 'Hello, this is a sample text file created without external libraries.';

// Define the file path
const filePath = 'sample.txt';

// Write the content to the file
writeFile(filePath, content, (err) => {
    if (err) {
        console.error('Error writing to file:', err);
    } else {
        console.log('File written successfully:', filePath);
    }
});