# How to install this project

##Disclaimer
You can test this project creating an `free tier` instance on amazon ec2 (i choose this one: Amazon Linux 2 AMI (HVM) - Kernel 5.10, SSD Volume Type - ami-002068ed284fb165b (64-bit x86) / ami-0a5899928eba2e7bd (64-bit Arm)
). In order to install `docker` and `docker-compose` you can follow this  [gist](https://gist.github.com/npearce/6f3c7826c7499587f00957fee62f8ee9)

## Pre requisites
1. `docker`
2. `docker-compose`
3. `git`

## Instalation
1. `sudo yum install -y git`
2. `git clone https://github.com/samhk222/laravel-arena`
3. `cd laravel-arena #Enter the directory`
4. `./.start.sh #to run instalation script, or just type the commands that are inside that file`
5. Add `127.0.0.1 laravel-arena.local` at the end of you `/etc/hosts` file
6. Navigate to http://laravel-arena.local (or http://0.0.0.0)
