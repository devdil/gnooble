


Gnooble
==============================================

Gnooble is an intelligent platform to automate programming assignments on the cloud. Built for institutions, trainers and students, it primarily aims to provide a place for students to practice coding challenges and improve their skills. Students can collaborate, track their skills and work together with their peers.

Institutions and Trainers can leverage this platform by hosting hackathons and coding competitions and get insights on a student's skills and performance, grade them remotely.


## _For Students_

### Practice online
Gnooble provides an online platform for students to practice programming assignments online. Complete assignments, keep track of your scores, progress and flaunt them to your peers!

### Improve your skills
Solve numerous challenges on our platform and compete with your peers to improve and work on your problem solving skills. Discuss and brainstorm hard problems with our growing community.

## _For Schools_

### Coding Platform
Gnooble is an online platform for colleges and universities as well as employers to host hackathons, code competitions and programming assignments online and grade them remotely.

### Monitor Progress
We collaborate with universities and colleges to host programming assignments and hackathons online. Teachers can monitor each of their student's work, grade and analyze their progress, thereby being able to teach effectively and improving student's skill through practice.

### Fully Automated
Run automated public or private programming assignments in the cloud. Add questions, track scores and run competitions at your own convenience.


Our Tech Stack
===============================================
* PHP 
* MySQl
* Bootstrap
* JavaScript
* Jquery

# Requirements 
* PHP >= 7.0
* MYSQL >=10.0
* HackerRank API Keys
* LInux Distribution (Ubuntu/CentOS) 

## Usage

Here is how you can get started:

1) [Sign Up for HackerRank API](https://www.hackerrank.com/api)

* Click on get started

  ​

  ![step1](https://s27.postimg.org/o5wmqe5f7/hackerrank_api.png)

  ​

* Give a name, description and click on "Generate your API code"

  ​

  [![step2.png](https://s23.postimg.org/db3xoh2p7/step2.png)](https://postimg.org/image/ongj69bdz/)

  Save this key somewhere in a text file, we will be needing this during application configuration.

#### 1)  [Spin up a digital ocean linux droplet](https://www.digitalocean.com/)
```Choose ubuntu 16.04 or higher, since the script is well tested on Ubuntu and it is assured that it will work. For other operating systems, you may need to tweak the install.sh script```

#### 2)  Download this project on your droplet/Linux instance by

  ``` git clone https://github.com/devdil/gnooble.git```

3) Edit your configuration files for the application

   The application relies on Hackerrank's API to compile and validate your sourcecode and this needs to be saved in our configuration files. The configuration file stores the API key and the password for MYSQL database which you will need later during application installation. Please make sure you use the same password during installation.

```BASH
$ cd gnooble/app/compiler/
$ vi apikey.php
```

Replace the highlighted area with the HackerRank api key you obtained in Step 1

[![highlighted.png](https://s23.postimg.org/seszsri7f/highlighted.png)](https://postimg.org/image/p7yg94xrb/)

Let's do the same for database configuration as well,

```shell
$ vi gnooble/app/includes/_config.php
```

Replace the highlighted area with the desired password but make sure you note it down somewhere in a text file. You will need this password during software installation (Step 3)

[![highlighted2.png](https://s27.postimg.org/t5xizyhbn/highlighted2.png)](https://postimg.org/image/i6cbocqwf/)



#### 3)  Install the application

 This includes setting up project files, setting up database, executing user queries,etc.


```bash
$ cd install
$ chmod 755 install.sh
$ ./install.sh
```


If everything goes well, you will get a message
       ``` Successfully installed application```


​     
#### 4) Start the application

You may fire up your favourite browser, and type the digital ocean IP address that you've got in Step 1 in the address bar, if you see a awesome screen like down below, you are ready and set  to go my boy!!! 

You can login with default credentials:
```
   emailid/username : admin@gnooble.com
   password 		: admin123
```

[![home screen.png](https://s23.postimg.org/qvsi3cy17/home_screen.png)](https://postimg.org/image/i0rnsu98n/)




Authors:
=================

* [Diljit Ramachandran](www.facebook.com/diljitpr) OR (www.diljitpr.net)
* [Sougata Nair](https://sougatanair.com)


