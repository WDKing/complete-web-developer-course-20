#!C:\acquired\python\python38\python.exe
print('Content-type: text/html\n')

def sayHello():
	print("Hello")

sayHello()

def saySomething(something):
	print(something)

saySomething("Hi there!")

def multiplyTwoNumbers(x, y):
	return x * y

print(multiplyTwoNumbers(2, 3))
print(multiplyTwoNumbers(4, 6))
print('')
#Create a function highestCommonFactor which returns the highest number 
#that divides into two other numbers exactly

def highestCommonFactor(x, y):
	count = 1
	highest = 1

	while count <= x and count <= y:
		if x % count == 0 and y % count == 0:
			highest = count
		count += 1

	return highest

print(highestCommonFactor(10, 15))
print(highestCommonFactor(30, 60))
print(highestCommonFactor(7, 35))
print(highestCommonFactor(37, 43))
print(highestCommonFactor(3, 8))
print(highestCommonFactor(82, 508))
print(highestCommonFactor(111, 247))
print(highestCommonFactor(84, 14))
print('')


a = 5
b = 6

def addTwoNumbers():
	a = 10
	return a + b

print(addTwoNumbers())
print(a)