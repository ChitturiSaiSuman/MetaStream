import os
import sys
filenames = os.listdir()
group = []
for file in filenames:
	if ".mp4" in file:
		file1 = file
		folder_name = file[:len(file)-4]
		file2 = folder_name + "_thumb.png"
		file3 = folder_name + "_WebLarge.png"
		os.system("mkdir " + folder_name)
		os.system("mv "+file1+" "+folder_name)
		os.system("mv "+file2+" "+folder_name)
		os.system("mv "+file3+" "+folder_name)
