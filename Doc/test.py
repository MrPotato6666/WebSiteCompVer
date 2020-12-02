# -*- coding: utf-8 -*-
"""
Created on Fri Sep 13 14:35:34 2019

@author: peezflay
"""

def scan_input():
    index = int(input("\nplease enter which index you wan to key in\n"))
    ans = input("\nplease enter your answer\n")
    
    return index-1, ans

def display_question():
    print(word_t)
    print(choice)

import random
import string

word = ["h","e","l","l","o"]
word_t = []
empty = []
left = []
choice = []
slot = []

num = int(len(word)/2 + 1)
for anything in word:
    word_t.append(anything)


while len(left) != num:
    ntemp = random.randint(0,len(word)-1)
    if ntemp not in slot:
        slot.append(ntemp)
        word_t[ntemp] = "_"
        left.append(word[ntemp])

for anything in left:
        choice.append(anything)
       
while len(choice) != 10:
    z = random.choice(string.ascii_lowercase)
    if z not in choice:
        choice.append(z)

display_question()

while word_t != word:
    index, ans = scan_input()
    if(index >= len(word) or index < 0):
        print("Invalid index\n")
        continue
    elif(ans not in choice):
        print("Invalid answer\n")
        continue
    if ans == word[index]:
        word_t[index] = ans
        print("Your answer for index: "+str(index+1)+" is correct, please try other\n")
    else:
        print("Your answer for index: "+str(index+1)+" is wrong, please try again\n")
    print("\033[H\033[J") #clear screen
    display_question() 
    
print("\nYou Won The Game")



