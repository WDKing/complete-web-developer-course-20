#!C:\acquired\python\python38\python.exe
print('Content-type: text/html\n')

for i in range(11):
	print(i)

foods = ["Pizza", "Pasta", "Steak"]

for i in foods:
	print('I like eating ' + i)

x = 0

while x <= 10:
	print(x)
	x = x + 1


# Dictionary - 4 names (keys) and ages (values) of people
# Loop prints age of each person

crewDict = {"Malcolm": 49, "Zoe": 33, "Wash": 31, "Jane": 36, "Kaylee": 23, "Simon": 27, "River": 17}

print(crewDict.items())
for crew in crewDict: 
	print(crew + ", " + str(crewDict[crew]))
