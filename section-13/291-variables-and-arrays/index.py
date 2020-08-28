#!C:\acquired\python\python38\python.exe

print('Content-type: text/html\n')
print('Hello world\n')

age = 36
print(age)

pi = 3.14
print(pi)

name = "Roberto"
print(name + '\n')

print(age/pi)

number = "5"
print(int(number) * pi)

str = "My Name is "
print(str[0])
print(str[0:5])
print(str[5])

print(str + name)

myList = ["Clark", "Bruce", "Diana", "Dick", "Steve"]
print(myList)
print(myList[1])
print(myList[2:5])
print('')

myTuple = (1, 2, 3, 4)
print(myTuple)
print(myTuple[2])
print('')

dict = {}
dict["Father"] = "Anakin"
dict["Son"] = "Luke"
dict[1] = "Leia"
dict[2] = "Padme"
print(dict.keys())
print(dict.items())
print(dict.values())
print(dict[2]);
for key in dict:
	  print(dict[key])

print('\n')
