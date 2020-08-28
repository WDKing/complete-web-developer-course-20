#!C:\acquired\python\python38\python.exe
print('Content-type: text/html\n')

#i = -1

#if i > 5 or i < 1:
#	print("Hello")
#else: 
#	print("Goodbye")


# Create a program which displays the first 50 prime numbers



primeCount = 0;
currentValue = 2;
prime = 'false'
count = 2

while primeCount < 50:
	prime = 'true'
	count = 2

	while count < (currentValue / 2) + 1:
		if currentValue % count == 0:
			prime = 'false'

		count += 1

	if prime == 'true':
		print(str(currentValue), end = " ")
		primeCount += 1

	currentValue += 1


print('')
print("Instructor's:")
# Instructor's Process
numberOfPrimes = 0
number = 2

while numberOfPrimes < 50:
	isPrime = True
	for i in range(2, number):
		if number % i == 0:
			isPrime = False

	if isPrime == True:
		print(number, end = ' ')
		numberOfPrimes += 1

	number += 1
