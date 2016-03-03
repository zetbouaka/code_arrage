#!/usr/bin/python
 
import subprocess, time
import sys
import os

def execute(cmd) :
    fd = subprocess.Popen(cmd, shell=True,
            stdin=subprocess.PIPE,
            stdout=subprocess.PIPE,
            stderr=subprocess.PIPE)

    return fd.stdout, fd.stderr

def run(cmd) :
     
    std_out, std_err = execute(cmd)
    
#    print std_out.readlines(), std_err.readlines()

    return std_out, std_err

def test_program(codename, pname, t):
    #filename = codename
    #problemname = pname
    #testcase = the number of data

#    os.system("g++ " + os.getcwd() + "/test/A.cpp")

#    path = os.getcwd()

#    os.system("pwd")
#    result = subprocess.check_output(['g++', os.getcwd() + '/test/A.cpp'], stderr=subprocess.STDOUT)

#    os.system("g++ -o test/test.exe test/A.cpp")
#    return 0

    c1_out, c1_err = run("g++ -o ./test/testprogram ./test/A.cpp")

    if c1_err.readlines() != []:
        print "Compile Error"
        return False
    
    #if te != None:
        #print "Compile Error"
    #    return False

    score = 0
#    print "E"

    for i in range(1, t+1):
#        string = "<problem/" + pname + "/input" + str(i) + ".txt>"
        om=open("problem/" + pname + "/input" + str(i) + ".txt", "r")
        ou=open("test/output.txt", "w")

    	#os.system("ls")

#	return 0
#        print om.readline()
        
        p = subprocess.Popen("./test/testprogram", stdin=om, stdout=ou)
        #p.wait()
        time.sleep(1)

        if p.poll() is None:
            p.kill()
            print 'Time out'
            continue
        
        #p.wait()

        #ou.write("3")
        
        ou.flush()
        print str(i) + "th data : "
                
        ou.close()

        #c1_out = p.stdout
        #c1_err = p.stderr
    

        #if c1_out.readlines() != []:
        #    print "Runtime Error"
        #    continue

        f1 = open("test/output.txt", "r")
        f2 = open("problem/" + pname + "/output" + str(i) + ".txt", )
        flag = 0
        while True:
            f1_re = f1.readline().strip()
            f2_re = f2.readline().strip()
            if (f1_re == "") and (f2_re == ""): break
            if (f2_re == "") or (f2_re == ""): flag=1
            if (f1_re != f2_re):
                print "Wrong Answer<br>"
#                print "Your data = " + f1_re + " And Our data = " + f2_re
#                print "OK"
                flag = 1

        if flag == 0:
            print "Correct Answer<br>"
            score = score + 10
        
    return score

def scoring(pname):
    check = test_program("A.cpp", pname, 1)
    return check

if __name__ == "__main__": 
    print "Sum = " + str(scoring(sys.argv[1]))

