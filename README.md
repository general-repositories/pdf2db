## Dependencies:

	smalot/pdfparser

	### Installation:
    
		Using Composer:
 
			Obtain Composer  
			Run 'composer install'  


## Version:

	1.0.1

## Features:  

	Plugin designed to work with UltimateMember  
	When creating a new upload form, meta-key must be set to 'onward_resume_file'  

	Utilizes PDFParser to stringify uploaded PDF file to the user metadata  
	String is sanitized before upload to metadata  
	Adds search functionality for meta-key  


## Admin Setup:

	One must restrict accepted file types in the upload form to ONLY PDF for security. 