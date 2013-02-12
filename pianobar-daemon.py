#!/usr/bin/python
import daemon
import subprocess as sub
#import os
with daemon.DaemonContext():
#    os.system("pianobar")
     sub.call("pianobar")
