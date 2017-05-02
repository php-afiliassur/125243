awk -F "," '{system("ssh-copy-id root@"$1)}' hosts
