
  // JavaScript function to handle file preview
  document.getElementById('file_select').addEventListener('change', function() {
    const fileInput = this.files[0];
    const previewContainer = document.getElementById('file_preview');
    const imgPreview = document.getElementById('img_preview');
    const pdfPreview = document.getElementById('pdf_preview');
    const fileInfo = document.getElementById('file_info');
    
    previewContainer.style.display = 'none';
    imgPreview.style.display = 'none';
    pdfPreview.style.display = 'none';
    fileInfo.style.display = 'none';

    if (fileInput) {
      const fileType = fileInput.type;

      // Reset preview fields
      imgPreview.src = "";
      pdfPreview.src = "";

      const reader = new FileReader();

      // If the file is an image (jpg/png), display it
      if (fileType.startsWith('image/')) {
        reader.onload = function(e) {
          imgPreview.src = e.target.result;
          imgPreview.style.display = 'block';
        };
        reader.readAsDataURL(fileInput);
      }
      // If the file is a PDF, display it in the <embed> tag
      else if (fileType === 'application/pdf') {
        const fileURL = URL.createObjectURL(fileInput);
        pdfPreview.src = fileURL;
        pdfPreview.style.display = 'block';
      }
      // For other file types (e.g., DOC/DOCX), just show the file name and size
      else {
        fileInfo.textContent = `Selected File: ${fileInput.name} (${(fileInput.size / 1024).toFixed(2)} KB)`;
        fileInfo.style.display = 'block';
      }

      // Show the preview container
      previewContainer.style.display = 'block';
    }
  });




