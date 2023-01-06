#include<sys/types.h>
#include<sys/stat.h>
#include<fcntl.h>
#include<unistd.h>
#include<stdlib.h>
#include<string.h>




int main(int argc, char *argv[]){
    
    int fdsource, fdcopy, fddir; /*file descriptors and dir descriptor*/
    char buf[1024]; /*buffer*/
    char *openErrorS = "error:Source file does not exist\n";
    char *openErrorC = "error:Copy file already exist\n";
    char *dirError = "error:Unclear directory \n";
    char *comError = "error:Unknown command, please use -d, followed by destination directory\n";		/*error content*/
    char *successC = "Copy successfully\n";   	/*Execute successfully message*/
    
    char *filename;
    filename = strrchr(argv[1],'/'); /*get the file name from the path of the source file*/
    filename ++; /*filename move to the next position*/
    
    /*To check that if the number of arguments is 4, if it is, implement copy a specific file to a specific directory*/
    if(argc == 4){
    
    	if((strcmp(argv[2],"-d")) == 0){  /*To check that if the 3rd argument is -d*/
			fdsource = open(argv[1], O_RDONLY); /*open source file*/
			
			if(fdsource == -1){   /*if open() system call returns -1, which means that fail to open the file, then output the error message and exit with a value 1*/
				write(2,openErrorS, strlen(openErrorS)); 
				exit(1);  
			}
			else{					
					if((argv[3] != NULL) && (fddir = chdir(argv[3]) != -1)){ /*To check that if the destination directory is valid*/
							
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
    	if((strcmp(argv[1],"-d")) == 0){
			fdsource = open("logfile.txt", O_RDONLY);
			if(fdsource == -1){
				write(2,openErrorS, strlen(openErrorS));
				exit(1);
			}
			else{
					if((argv[2] != NULL) && (fddir = chdir(argv[2])!= -1) ){
				
						fdcopy = open("logfile.txt",O_EXCL | O_CREAT | O_RDWR, 0644);
						if(fdcopy == -1){
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
