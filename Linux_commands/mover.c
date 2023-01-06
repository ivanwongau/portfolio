#include<unistd.h>
#include<sys/types.h>
#include<sys/stat.h>
#include<fcntl.h>
#include<string.h>
#include<stdlib.h>
#include<stdio.h>

int main(int argc, char *argv[]){

	int fdsource, fdcopy, fddir;  /*file descriptors and dir descriptor*/
    char buf[1024];			/*the buffer used to hold the content from read system call*/
    char *openErrorS = "error:Source file does not exist\n";
    char *openErrorC = "error:Copy file already exist\n";
    char *dirError = "error:Unclear directory \n";
    char *comError = "error:Unknown command, please try sourcePath -d destinationDirectory -M\n";			/*error content*/
    char *successC = "Copy successfully\n";
    char *successM = "Move successfully\n";					/*Execute successfully message*/
    
    
    char *filename;
    filename = strrchr(argv[1],'/'); /*get the file name from the path of the source file*/
    filename ++; /*filename move to the next position*/
    
    
    	/*Move a specific file to a specific directory*/
    if(argc == 5){
    
    	if(((strcmp(argv[2],"-d")) == 0) && (strcmp(argv[4],"-M") == 0)){	/*To check that if input command is valid*/
			fdsource = open(argv[1], O_RDONLY); 	/*open the source file with read only flag*/
			
			if(fdsource == -1){  /*if open() system call returns -1, which means that fail to open the file, then output the error message and exit with a value 1*/
				write(2,openErrorS, strlen(openErrorS));
				exit(1);
			}
			else{
					/*Check if the path argument is valid, and change directory to destination directory*/
					if((argv[3] != NULL) && ((fddir = chdir(argv[3])) != -1)){
						
						if((fdcopy = open(filename,O_EXCL | O_CREAT | O_RDWR, 0644)) == -1){
							write(2,openErrorC, strlen(openErrorC));
							exit(2);
								
						}
						else{ 
							          
							unlink(argv[1]);
							
							while(read(fdsource, buf, strlen(buf))){
								write(fdcopy, buf, strlen(buf));
							}
							write(1,successM,strlen(successM)); 	
						}            
					}
					else{
						write(2,dirError, strlen(dirError));
						exit(2);
					}
			}	
		}
		        
		else{
		           
			write(2,comError, strlen(comError));
			exit(1);
		}      		
		
    }
    else if(argc == 4){
    
    	if(((strcmp(argv[1],"-d")) == 0) && (strcmp(argv[3],"-M") == 0)){	/*To check that if input command is valid*/
			
			if((fdsource = open("logfile.txt", O_RDONLY)) == -1){
			
				write(2,openErrorS, strlen(openErrorS));/*if open() system call returns -1, which means that fail to open the file, then output the error message and exit with a value 1*/
				exit(1);
			}
			else{
					
					unlink("logfile.txt");
					
					 /*Check if the path argument is valid, and change directory to destination directory*/
					if((argv[2] != NULL) && ((fddir = chdir(argv[2])) != -1)){
						
						if((fdcopy = open("logfile.txt",O_EXCL | O_CREAT | O_RDWR, 0644)) == -1){
						
							write(2,openErrorC, strlen(openErrorC));
							exit(2);
						}
						else{               
							while(read(fdsource, buf, strlen(buf))){
								write(fdcopy, buf, strlen(buf));
							}
							
							write(1,successM,strlen(successM));
										
						}            
					}
					else{
						write(2,dirError, strlen(dirError));
						exit(2);
					}
			}
		}
		else if((strcmp(argv[2],"-d")) == 0){		/*To check that if input command is valid*/
			fdsource = open(argv[1], O_RDONLY);
			
			if(fdsource == -1){
				write(2,openErrorS, strlen(openErrorS));/*if open() system call returns -1, which means that fail to open the file, then output the error message and exit with a value 1*/
				exit(1);
			}
			else{
					/*Check if the path argument is valid, and change directory to destination directory*/
					if((argv[3] != NULL) && ((fddir = chdir(argv[3])) != -1)){
							
							if((fdcopy =open(filename,O_EXCL | O_CREAT | O_RDWR, 0644)) == -1){
								write(2,openErrorC, strlen(openErrorC));
								exit(2);
									
							}
							else{               
									
								while(read(fdsource, buf, strlen(buf))){
									write(fdcopy, buf, strlen(buf));
								}
								write(1,successC,strlen(successC)); 
								
									
							}
						           
						}
			
					else{
						write(2,dirError, strlen(dirError));
						exit(2);
					}
			}	
		}   		
		else{
			write(2,comError, strlen(comError));
			exit(1);
		}       
				   
			
    }
    else if(argc == 3){
    	if((strcmp(argv[1],"-d")) == 0){		/*To check that if input command is valid*/
			fdsource = open("logfile.txt", O_RDONLY);
			if(fdsource == -1){
				write(2,openErrorS, strlen(openErrorS));/*if open() system call returns -1, which means that fail to open the file, then output the error message and exit with a value 1*/
				exit(1);
			}
			else{	 
					/*Check if the path argument is valid, and change directory to destination directory*/
					if((argv[2] != NULL) && ((fddir = chdir(argv[2])) != -1)){
	
						if((fdcopy = open("logfile.txt",O_EXCL | O_CREAT | O_RDWR, 0644)) == -1){
							write(2,openErrorC, strlen(openErrorC));
							exit(2);
								
						}
						else{               
							
							while(read(fdsource, buf, strlen(buf))){
								write(fdcopy, buf, strlen(buf));
							}
							
							write(1,successC,strlen(successC));
							
											
						}            
					}
					else{
						write(2,dirError, strlen(dirError));
						exit(2);
					}
			}
		}
		else{
			write(2,comError, strlen(comError));
			exit(1);
		}       
				   
			
    }
    else{
    	write(2,comError, strlen(comError));
    }
    
    
	
	close(fdsource);
	close(fdcopy);
	
	return 0;
}
