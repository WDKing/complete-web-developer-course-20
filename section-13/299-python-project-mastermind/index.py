#!C:\acquired\python\python38\python.exe
print('Content-type: text/html\n')

import cgitb
cgitb.enable()

import cgi 
form = cgi.FieldStorage()

import random
import string

# Creation of 'Constants' and initiation of used strings

ANS_MIN = 1
ANS_MAX = 6
ANS_LENGTH = 4

historyString = " "
solutionString = ""
alertMessage = ""

### Beginning of functions

# Determine if submission is a valid format
def validGuess(unknownGuess):
	valid = unknownGuess.isnumeric() and len(unknownGuess) == ANS_LENGTH and int(unknownGuess) >= 0

	if valid:
		for i in range(0,ANS_LENGTH):
		  if int(unknownGuess[i]) > ANS_MAX:
		  	valid = False

	return valid

# Compare guess to answer, providing response string
def mastermindCompare(guess, solution):
	answerString = ""
	currentAnswer = []
	guessUsedArray = []
	solutionUsedArray = []

	# Populate Arrays, and Check for Correct Locations
	for h in range(0,ANS_LENGTH):
		guessUsedArray.append(0)
		solutionUsedArray.append(0)
		currentAnswer.append("-")

		if guess[h] == solution[h]:
			currentAnswer[h] = "B"
			guessUsedArray[h] = 1
			solutionUsedArray[h] = 1

	# Check for correct colors, incorrect locations
	for i in range(0,ANS_LENGTH):
		for j in range(0,ANS_LENGTH):
			if guess[i] == solution[j] and guessUsedArray[i] == 0 and solutionUsedArray[j] == 0:
				currentAnswer[j] = "W"
				guessUsedArray[i] = 1
				solutionUsedArray[j] = 1
				break

	# Form Solution Response String

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

# Create the submission form, allowing for error messages and alerts, and game end
def createPostForm(message, history, solution, shown, submission):
	return '''<p>''' + str(message) + '''</p>
				<form method="post">
				<input type="''' + str(shown) + '''" name="guess">
  			<input type="hidden" name="historyPost" value="''' + str(history) + '''">
				<input type="hidden" name="solutionPost" value="''' + str(solution) + '''">
				<input type="submit" value="''' + str(submission) + '''">
				</form>'''


### Beginning of Logic - Determine if guess was made, guess is valid, guess is correct, or if it is game start
if 'solutionPost' in form and form.getvalue('solutionPost') != '': 
  solutionString = form.getvalue('solutionPost')
  historyString = form.getvalue('historyPost')

  if 'guess' in form:
  	
  	if validGuess(str(form.getvalue('guess'))) == True:
  		historyString = '' + mastermindCompare(form.getvalue('guess'),form.getvalue('solutionPost')) + ' ' + form.getvalue('guess') + '<br>' + str(historyString)
  		
  		if str(mastermindCompare(form.getvalue('guess'),form.getvalue('solutionPost'))) == "BBBB":
  			alertMessage = createPostForm('You have guessed correctly!', '', '', 'hidden', 'Play Again')
  		else:
  			alertMessage = createPostForm('Enter your guess:', str(historyString), str(solutionString), 'text', 'Go')
  	
  	else:
  		alertMessage = createPostForm('Not a valid guess, please try again.', str(historyString), str(solutionString), 'text', 'Go')
  
  else:
  	alertMessage = createPostForm('No guess was made.  Please make a guess.', str(historyString), str(solutionString), 'text', 'Go')	  

else: 
	solutionString = "" + str(random.randint(ANS_MIN,ANS_MAX)) + str(random.randint(ANS_MIN,ANS_MAX)) + str(random.randint(ANS_MIN,ANS_MAX)) + str(random.randint(ANS_MIN,ANS_MAX))
	alertMessage = createPostForm('Enter your guess.', str(historyString), str(solutionString), 'text', 'Go')


# Displaying the created form and guess history

print('<h3>Mastermind:</h3>')
print('<p>' + str(alertMessage) + '</p>')
print("<br><p>Guess History:</p>")
print('<p>' + str(historyString) + '</p>')