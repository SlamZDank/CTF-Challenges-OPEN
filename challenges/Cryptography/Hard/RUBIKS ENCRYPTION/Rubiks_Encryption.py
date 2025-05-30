import math, random

nums = {
            0 : ('L', 'F'),
            1 : ('R', 'B'),
            2 : ('U', 'L2'),
            3 : ('D', 'R2'),
            4 : ('F2', 'U2'),
            5 : ('B2', 'D2'),
            6 : ('L\'', 'F\''),
            7 : ('R\'', 'U\''),
            8 : ('B\'', 'D\'')
        }

moves = {
            'L' : 0,
            'F' : 0,
            'R' : 1,
            'B' : 1,
            'U' : 2,
            'L2' : 2,
            'D' : 3,
            'R2' : 3,
            'F2' : 4,
            'U2' : 4,
            'B2' : 5,
            'D2' : 5,
            'L\'' : 6,
            'F\'' : 6,
            'R\'' : 7,
            'U\'' : 7,
            'B\'' : 8,
            'D\'' : 8
        }

shuffleNums = dict()

"""
 ________  __    __   ______    ______   _______   ________
|        \|  \  |  \ /      \  /      \ |       \ |        \
| $$$$$$$$| $$\ | $$|  $$$$$$\|  $$$$$$\| $$$$$$$\| $$$$$$$$
| $$__    | $$$\| $$| $$   \$$| $$  | $$| $$  | $$| $$__
| $$  \   | $$$$\ $$| $$      | $$  | $$| $$  | $$| $$  \
| $$$$$   | $$\$$ $$| $$   __ | $$  | $$| $$  | $$| $$$$$
| $$_____ | $$ \$$$$| $$__/  \| $$__/ $$| $$__/ $$| $$_____
| $$     \| $$  \$$$ \$$    $$ \$$    $$| $$    $$| $$     \
 \$$$$$$$$ \$$   \$$  \$$$$$$   \$$$$$$  \$$$$$$$  \$$$$$$$$

"""

def embedPerm():
    permHeader = ''
    perm = list(range(0,9))
    random.shuffle(perm)
    for key in perm:
        shuffleNums[perm.index(key)] = nums[key]
    lPad = random.randint(0,8)
    permHeader += str(lPad)
    for i in range(0, lPad):
        permHeader += str(random.randint(0,8))
    for i in perm:
        permHeader += str(i)
    for i in range(0, 10 - lPad):
        permHeader += str(random.randint(0,8))
    nine = decToNine(int(permHeader))
    return nineToScramble(nine, 0)[0]

def nineToScramble(nine, dict):
    result = ''
    size = 0
    if dict:
        for num in str(nine):
            result += str(shuffleNums[int(num)][random.randint(0,1)]) + ' '
            size += 1
    else:
        for num in str(nine):
            result += str(nums[int(num)][random.randint(0,1)]) + ' '
            size += 1
    return (result, size)

def strToNine(plain):
    return decToNine(strToDec(plain))

def decToNine(decimal):
    result = ''
    power = math.floor(math.log(decimal, 9))
    while(decimal):
        div = 9 ** power
        result += str(decimal // div)
        decimal = decimal % div
        power -= 1
    return result

def strToDec(plain):
    return int(''.join(format(ord(x) , 'b').zfill(8) for x in plain), 2)

def embedLength(length):
    lengthHeader = ''
    lPad = random.randint(0,8)
    lengthHeader += str(lPad) + str(len(str(length)))
    for i in range(0, lPad):
        lengthHeader += str(random.randint(0,8))
    lengthHeader += str(length)
    for i in range(0, 18 - lPad - len(str(length))):
        lengthHeader += str(random.randint(0,8))
    nine = decToNine(int(lengthHeader))
    return nineToScramble(nine, 1)[0]

def padScramble(length, scramble):
    if length % 20 == 0:
        return
    pad = 20 - (length % 20)
    nine = ''
    for i in range(0, pad):
        nine += str(random.randint(0,8))
    return scramble + nineToScramble(nine, 1)[0]

def encode(plain):
    perm = embedPerm()
    encoded = nineToScramble(strToNine(plain), 1)
    padded = padScramble(encoded[1], encoded[0])
    length = embedLength(encoded[1])
    return perm + ',' + length + ',' + padded

"""
 __       __   ______   ______  __    __
|  \     /  \ /      \ |      \|  \  |  \
| $$\   /  $$|  $$$$$$\ \$$$$$$| $$\ | $$
| $$$\ /  $$$| $$__| $$  | $$  | $$$\| $$
| $$$$\  $$$$| $$    $$  | $$  | $$$$\ $$
| $$\$$ $$ $$| $$$$$$$$  | $$  | $$\$$ $$
| $$ \$$$| $$| $$  | $$ _| $$_ | $$ \$$$$
| $$  \$ | $$| $$  | $$|   $$ \| $$  \$$$
 \$$      \$$ \$$   \$$ \$$$$$$ \$$   \$$

"""

def main():
    plain = input('Input plaintext: ')
    print(encode(plain))

main()