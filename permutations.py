import sys
import itertools

# 20.9 trillion permutations possible
# Used wordsmith.org/anagram/anagram.cgi?anagram=northeast+novices&language=english&t=0&d=4&include=&exclude=&n=4&m=4&source=adv&a=y&l=n&q=n&k=0
# to limit list to 23710 uniques
# Those 23710 needed to be permutated and have 4 elements so (4! = 24); 24 * 23710 = 569,040 possibilities to test
# Used http://www.scrabble.org.au/words/fours.htm for 4 letter word dictionary

def doIt(line, wordList):
	four = line.split()
	twofour = list(itertools.permutations(four))
	answer = ""
	for four in twofour:
		test = (four[0][0]+four[1][0]+four[2][0]+four[3][0]).upper()
		test1 = (four[0][1]+four[1][1]+four[2][1]+four[3][1]).upper()
		test2 = (four[0][2]+four[1][2]+four[2][2]+four[3][2]).upper()
		test3 = (four[0][3]+four[1][3]+four[2][3]+four[3][3]).upper()
		if test in wordList and test1 in wordList and test2 in wordList and test3 in wordList:
			answer = list(four)
	return answer

def main():
	words = open('words.txt')
	anagrams = open('anagrams.txt')
	letters = ["N", "O", "R", "T", "H", "E", "A", "S", "V", "I", "C"]
	answers = []
	wordList = []
	for line in words:
		p = True
		line = line.strip('\n')

		# only include the words that contain letters we are searching for
		for x in range(4):
			if line[x] not in letters:
				p = False
		if p:
			wordList.append(line)

	for line in anagrams:
		a = doIt(line, wordList)
		if a != "":
			answers.append(a)

	for answer in answers:
		print "\n"
		print "\n".join(answer)

main()