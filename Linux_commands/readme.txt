This documentation describes the instructions for complying the following programs in a terminal of the linux Operating System: displayer.c , copier.c, mover.c .

All the programs are written in C programming language. And these programs are coded to display the coder's ability of using system calls to communicate with the Operating System in the lower level layer.

The program displayer.c has the functionality of displaying a .txt file's contents. The copier.c is able to copy a .txt file from a specific directory into another. And the mover.c is the upgraded version of the copier.c, besides the functionality that copier has, it also can move the target .txt file from a specific directory to another. 

In order to compile the programs, please use command: gcc filename.c -o filename , and then run it with the command: ./filename [argument1] [argument2] ... 

For different program, the number of arguments is different, or you are not required to type any arguments in. In any of these programs, if user do not specify any filename at the second position of the command, the default file called "logfile.txt" will be executed, otherwise, the input file at the 2nd position will be executed. However, if the default file or the specified file does not exist, the program would output an error to the screen.

The specific command used to run each program and the functionality activated by that command list below: 

******Please use the absolute path of file at the postion of "filepath"， for example: /root/Documents/logfile.txt******

******Warning: To let the programs function properly, please do not open the target .txt file in another window and make sure that you have followed the instruction provided in this documentation and have typied in the correct commands.******


To comply the program displayer.c:

gcc displayer.c -o displayer   			/*compile the program*/

./displayer					/*output the content of the default file which is"logfile.txt"*/

./displayer filepath				/*output the content of a specific file*/
****************************************************************************************
To comply the program copier.c:

gcc copier.c -o copier				/*compile the program*/

./copier -d destinationDirectory  		/*copy the default file "logfile.txt" to a specific directory*/

./copier filepath -d destinationDirectory  	/*copy a specifi file to a specific directory*/
****************************************************************************************
To comply the program mover.c:

gcc mover.c -o mover				/*compile the program*/

./mover -d destinationDirectory  		/*copy the default file "logfile.txt" to a specific directory*/

./mover filepath -d destinationDirectory  	/*copy a specifi file to a specific directory*/

./mover -d destinationDirectory -M     		/*move the default file "logfile.txt" to a specific directory*/

./mover filepath -d destinationDirectory -M  	/*move a specific file to a specific directory*/
****************************************************************************************



This is the end of this documentation.

