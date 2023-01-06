#include<sys/types.h>
#include<sys/stat.h>
#include<fcntl.h>
#include<unistd.h>
#include<stdlib.h>
#include<string.h>
#include<errno.h>


int main(int argc, char *argv[]){

    int fd; /*file descriptor and the numbers for the result of read*/
    char buf[1024]; /*the buffer used to hold the content from read system call*/
    char *errorO = "Fail to open the file\n";
    char *errorR = "Fail to read the file\n";
    char *errorC = "Invalid command\n";
    if(argc == 2){
        if((fd = open(argv[1], O_RDONLY)) == -1){
        	write(2,errorO,strlen(errorO));
        	exit(1);
        }
        else{
        	while(read(fd, buf, strlen(buf))){
        		write(1,buf,strlen(buf));
    		}
        }
    }
    else if(argc == 1){
        
        if((fd = open("logfile.txt",O_RDONLY)) == -1){
            write(2,errorO, strlen(errorO));
            
            exit(1);
        }
        else{
        	while(read(fd, buf, strlen(buf))){
        	write(1,buf,strlen(buf));
    		}
        }
    }
    else{
    	write(2,errorC,strlen(errorC));
    }   
    
    
    
    close(fd);
    
    return 0;
}
