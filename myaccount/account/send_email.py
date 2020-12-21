import smtplib 
from email.mime.multipart import MIMEMultipart 
from email.mime.text import MIMEText 
from email.mime.base import MIMEBase 
from email import encoders 
import sys

fromaddr = "ADMIN EMAIL ADDRESS"
toaddr = sys.argv[1]
otp = sys.argv[3]
name = sys.argv[2]

msg = MIMEMultipart() 

msg['From'] = fromaddr 

msg['To'] = toaddr 

msg['Subject'] = "Meta Stream Account Verification - regd"

body = "Hi "+name+",\n"+"Your Meta Stream Account Verification code is " + otp

msg.attach(MIMEText(body, 'plain')) 

s = smtplib.SMTP('smtp.gmail.com', 587) 

s.starttls() 

s.login(fromaddr, "PASSWORD") 

text = msg.as_string() 

s.sendmail(fromaddr, toaddr, text) 

s.quit() 
