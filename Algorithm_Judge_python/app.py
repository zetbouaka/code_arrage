from flask import Flask, session, redirect, url_for, escape, request, render_template

import subprocess
import os
from test import test

app = Flask(__name__)

@app.route('/problem/<pname>')
def show_problem(pname):
    f = open("problem/"+pname+"/problem.txt", "r")

    s = ""
    while True: 
        line = f.readline()
        if not line: break 
        print(line)
        s = s + line
    
    s1 = s.decode('utf-8')
    return render_template('bootstrap.html') + s1

@app.route('/problemset')
def show_problem_list():
    f = open("problem/problem_list.txt", "r")
    list = []

    while True:
        line = f.readline()
        if not line: break
        list.append(line)
    f.close()

    return render_template('bootstrap.html') + render_template('problem_list.html', list=list)


@app.route('/submit/score/<pname>', methods=['POST'])
def scoring(pname):
#    print("I got it!")
    s = request.form['src']
    f = open("test/A.cpp", "w")
    f.write(s)
    f.close()

    #f = open("problem/problem_list.txt", "r")
    #list = []
    
    p = subprocess.Popen("python test/test.py " + pname + " > result.txt", shell=True,
    stdin=subprocess.PIPE, stdout=subprocess.PIPE, close_fds=True)

    p.wait()

    s = open("result.txt", "r")
    s2 = s.read()

    return render_template('bootstrap.html') + s2


@app.route('/submit/<pname>')
def submit(pname):
    f = open("problem/problem_list.txt", "r")

    return render_template('bootstrap.html') + render_template('submit.html', pname=pname)

@app.route('/index')
def index_page():
    return render_template('bootstrap.html') + render_template('index.html')

@app.route('/', methods=['GET', 'POST'])
def root_page():
    return redirect(url_for('index_page'))
    
if __name__ == '__main__':
    app.run(debug=True)
