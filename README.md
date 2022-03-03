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
	
	This setup guide is for our testing purposes  
	
	Install Ultimate Member plugin  
		https://ultimatemember.com/  
	Install pdf2string plugin
	
	In WP admin, navigate to Ultimate Member > Forms > 'Add New'  
	Create new form, titled 'pdf file upload' for example.   
	Select File Upload from options  
	Add 'onward_resume_file' to the meta-key file  
	One must restrict accepted file types in the upload form to ONLY PDF for security.  
	Copy form shortcode and add to user (applicant) template page  
	
	In WP admin, navigate to Ultimate Member > Member Directories > Members  
	In General options, ensure all user types are accesible in search according to your needs  
	In Search Options, enable search feature by clicking the checkbox  
	
	Visit site as user  
	Edit user profile  
	Upload pdf file  
	Update user profile  
	Go to member directory search page
	Search for keywords contained in the uploaded pdf
	

	<!-- B I T E -->
