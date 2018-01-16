#!/bin/sh

sudo apt-get update
sudo apt-get install software-properties-common
sudo apt-add-repository ppa:ansible/ansible -y
sudo apt-get update
sudo apt-get install ansible -y

cd /sync
ansible-playbook -i deploy/inventory/vagrant deploy/playbook.yml