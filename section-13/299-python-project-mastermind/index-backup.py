#!C:\acquired\python\python38\python.exe
print('Content-type: text/html\n')

import cgitb
cgitb.enable()

import cgi 
form = cgi.FieldStorage()

import random
import string


ANS_MIN = 0
ANS_MAX = 6
ANS_LENGTH = 4

historyString = " "
solutionString = ""
alertMessage = ""



def validGuess(unknownGuess):
	valid = unknownGuess.isnumeric() and len(unknownGuess) == ANS_LENGTH and int(unknownGuess) >= 0

	if valid:
		for i in range(0,ANS_LENGTH):
		  if int(unknownGuess[i]) > ANS_MAX:
		  	valid = False

	return valid

def mastermindCompare(guess, solution):
	answerString = "";
	currentAnswer = []
	usedArray = []

	for h in range(0,ANS_LENGTH):
		usedArray.append(0);
		currentAnswer.append("-")

		if guess[h] == solution[h]:
			currentAnswer[h] = "B"
			usedArray[h] = 1


	for i in range(0,ANS_LENGTH):
		for j in range(0,ANS_LENGTH):
			if guess[i] == solution[j] and usedArray[j] == 0:
				currentAnswer[j] = "W"
				usedArray[j] = 1
				break


	for o in range(0,ANS_LENGTH):	
		if currentAnswer[o] == "B":
			answerString += "B"


	for p in range(0,ANS_LENGTH):
		if currentAnswer[p] == "W":
			answerString += "W"


	for q in range(0,ANS_LENGTH):
		if currentAnswer[q] == "-":
			answerString += "-"

	return str(answerString)

mastermindString = ""


if 'solutionPost' in form: 
  solutionString = form.getvalue('solutionPost')
  historyString = form.getvalue('historyPost')

  if 'guess' in form:
  	if validGuess(str(form.getvalue('guess'))) == True:
  		historyString = '' + mastermindCompare(form.getvalue('guess'),form.getvalue('solutionPost')) + ' ' + form.getvalue('guess') + '<br>' + str(historyString)
  		


  		print('Can print here')
  		print('History: ' + str(historyString))
  		alertMessage = "Correct guess"
  	else:
  		alertMessage = "Not a valid guess."
  		print(str(alertMessage))
  else:
  	alertMessage = "No guess made."	  
else: 
	solutionString = "" + str(random.randint(ANS_MIN,ANS_MAX)) + str(random.randint(ANS_MIN,ANS_MAX)) + str(random.randint(ANS_MIN,ANS_MAX)) + str(random.randint(ANS_MIN,ANS_MAX))
	#solutionString = "" + str(random.randint(0,6)) + str(random.randint(0,6)) + str(random.randint(0,6)) + str(random.randint(0,6))
	#print('<p>' + str(solutionString) + '</p>')

"""
  	if validGuess(str(form.getvalue('guess'))):
 		  historyString = "---- " + form.getvalue('guess') + "<br>" + form.getvalue('historyPost')
"""
'''
	else:
		print('')
		'''
# TODO	  answer = "----"
# TODO	  nameString = answer + " " + str(form.getvalue('guess')) + "<br>" + str(form.getvalue('nameString'))


# Form to enter guesses
print('<h3>Mastermind:</h3>')
print('<p>Enter your guess:</p>')
print('<form method="post">')
print('<input type="text" name="guess">')
print('<input type="hidden" name="historyPost" value="' + str(historyString) + '">')
print('<input type="hidden" name="solutionPost" value="' + str(solutionString) + '">' )
print('<input type="submit" value="Go">')
print('<form>')

print('<p>' + str(alertMessage) + '</p>')

print("<br><p>Guess History:</p>")
print('<p>' + str(historyString) + '</p>')


#url = 'index.py'
#postValue = {'guess': input('Enter your guess: ')}

#valueBack = requests.post(url, data = postValue)

#print(valueBack.text)

#username = input("Enter username: ")
#print("Username is: " + username)


