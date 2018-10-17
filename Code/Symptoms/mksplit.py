file = open('spp.txt','r').read().split(',')
out = open('X.txt','a')
cnt = 0;
for word in file:
    s = str(word)
    if s[0] == 'x' or s[0] == 'X':
        out.write(s+'\n');
