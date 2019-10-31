#!D:\Python Installation Folder\python.exe

from collections import defaultdict
from heapq import *
import sys
import timeit
from datetime import date

path_bellman = []

class Node(object):
    def __init__(self, name):
        self.name = name
        self.pred = None
        self.mindistance = sys.maxsize
class Edge(object):
    def __init__(self,start,end,weight):
        self.weight = weight
        self.start = start
        self.end = end

class Algorithms(object):
    cycle = False
    path1 = []
    cost1 = 0

    def Bellman(self,vertexList , edgeL, source, end):
        source.mindistance = 0

        for i in range(0,len(vertexList)-2):
            for edge in edgeL:
                u = edge.start
                v = edge.end
                newDistance = u.mindistance + edge.weight

                if newDistance < v.mindistance:
                    v.mindistance = newDistance
                    v.pred = u

        for edge in edgeL:
            if (edge.start.mindistance + edge.weight) < edge.end.mindistance:
                print("Negative Cycle Detected")
                Algorithms.cycle = True
                return
        print("Shortest path to Target Vertex", end.mindistance)

        node = end

        while node is not None:
            path_bellman.append(node.name)
            print("%s ->" % node.name)
            node = node.pred

    def dijkstra(self,edges, v_from, v_to):
        g = defaultdict(list)
        for l,r,c in edges:
            g[l].append((c,r))

        q, dist = [(0,v_from,())], {v_from: 0}
        #print(dist)

        while q:
            (Algorithms.cost1, node, Algorithms.path1) = heappop(q)
            if Algorithms.cost1 > dist[node]:
                continue

            Algorithms.path1 += (node, )
            if node == v_to:
                return Algorithms.cost1
            for w, n in g.get(node, ()):

                oldc = dist.get(n, float("inf"))
                newc = Algorithms.cost1 + w
                if newc < oldc:
                    dist[n] = newc
                    heappush(q, (newc, n, Algorithms.path1))

    def binarySearch(self,L, target):
        start = 0
        end = len(L) - 1
        while start <= end:
            middle = (start + end)// 2
            midpoint = L[middle][0]
            if midpoint > target:
                end = middle - 1
            elif midpoint < target:
                start = middle + 1
            else:
                return middle

    def mergeSort(self,arr):
        if len(arr) >1:
            mid = len(arr)//2 #Finding the mid of the array
            L = arr[:mid] # Dividing the array elements
            R = arr[mid:] # into 2 halves

            self.mergeSort(L) # Sorting the first half
            self.mergeSort(R) # Sorting the second half

            i = j = k = 0

            # Copy data to temp arrays L[] and R[]
            while i < len(L) and j < len(R):
                if L[i][0] < R[j][0]:
                    arr[k] = L[i]
                    i+=1
                else:
                    arr[k] = R[j]
                    j+=1
                k+=1

            # Checking if any element was left
            while i < len(L):
                arr[k] = L[i]
                i+=1
                k+=1

            while j < len(R):
                arr[k] = R[j]
                j+=1
                k+=1

    def swapPositions(self,list):
        temp = []
        for i in range (len(list)):
            temp.append((list[i][1],list[i][0]))
        del list[:]
        for name in temp:
            list.append(name)

    def reverse(self,list):
        temp = []
        for i in range (len(list)):
            temp.append((list[i][1],list[i][0],list[i][2]))
        for name in temp:
            list.append(name)

    def parseRoad(self,edges, ganjilGenap):
        self.mergeSort(edges)
        temp = []
        for vertex in ganjilGenap:
            stillExists = True
            while stillExists :
                result = self.binarySearch(edges, vertex[0])
                if(result != None):
                    if(edges[result][1] == vertex[1]):
                        del edges[result]
                    elif(edges[result][1] != vertex[1]):
                        temp.append(edges[result])
                        del edges[result]
                elif(result == None):
                    stillExists = False
        for name in temp:
            edges.append(name)

    # def ganjilgenap(self,edges,ggList):
    #     if(go == True):
    #         file = open("ggRoad.txt","w+")
    #         cord1 = []
    #         for i in range(len(ggList)):
    #             cord1.append(points.get(ggList[i][0]))
    #         for i in range(len(cord1)):
    #             file.write(str(cord1[i]))
    #             if(i==len(cord1)-1):
    #                 break
    #             file.write("\n")
    #         file.close()
    #         self.parseRoad(edges,ggList)
    #         self.swapPositions(ggList)
    #         self.parseRoad(edges,ggList)
    #         del edges_bellman[:]
    #         for i in range(len(edges)):
    #             edges_bellman.append(Edge(nodedictionary.get(str(edges[i][0])),nodedictionary.get(str(edges[i][1])),edges[i][2]))
    #             edges_bellman.append(Edge(nodedictionary.get(str(edges[i][1])),nodedictionary.get(str(edges[i][0])),edges[i][2]))
    #
    #
    #     else :
    #         file = open("ggRoad.txt","w+")
    #         cord2 = ['2,2']
    #         for i in range(len(cord2)):
    #             file.write(cord2[i])
    #             if(i==len(cord2)-1):
    #                 break
    #             file.write("\n")
    #         file.close()
    def ganjilgenap(self):
        if (go == True):
            # MONAS KE MRT BLOK M
            filegg = open("ggRoad.txt","w+")

            cord1 = []
            for i in range(len(ggList)):
                cord1.append(points.get(ggList[i][0]))

            for i in range(len(cord1)):
            #print (cord1[i])f
                filegg.write(str(cord1[i]))
                if(i==len(cord1)-1):
                    break
                filegg.write("\n")
            filegg.close()
            self.parseRoad(edges,ggList)
            self.swapPositions(ggList)
            self.parseRoad(edges,ggList)

            # ANGGREK PANCORAN
            fileg = open("ggRoad2.txt","w+")
            cord1 = []
            for i in range(len(ggList2)):
                cord1.append(points.get(ggList2[i][0]))
            for i in range(len(cord1)):
                #print (cord1[i])f
                fileg.write(str(cord1[i]))
                if(i==len(cord1)-1):
                    break
                fileg.write("\n")
            fileg.close()

            self.parseRoad(edges,ggList2)
            self.swapPositions(ggList2)
            self.parseRoad(edges,ggList2)

            # SIMPANG SEMANGGI
            fileg = open("ggRoad3.txt","w+")

            cord1 = []
            for i in range(len(ggList3)):
                cord1.append(points.get(ggList3[i][0]))
            for i in range(len(cord1)):
                #print (cord1[i])f
                fileg.write(str(cord1[i]))
                if(i==len(cord1)-1):
                    break
                fileg.write("\n")
            fileg.close()

            self.parseRoad(edges,ggList3)
            self.swapPositions(ggList3)
            self.parseRoad(edges,ggList3)


            # GALLUNGGUNG KE GATOT SUBROTO
            fileg = open("ggRoad4.txt","w+")

            cord1 = []
            for i in range(len(ggList4)):
                cord1.append(points.get(ggList4[i][0]))
            for i in range(len(cord1)):
                #print (cord1[i])f
                fileg.write(str(cord1[i]))
                if(i==len(cord1)-1):
                    break
                fileg.write("\n")
            fileg.close()

            self.parseRoad(edges,ggList4)
            self.swapPositions(ggList4)
            self.parseRoad(edges,ggList4)
            del edges_bellman[:]
            for i in range(len(edges)):
                edges_bellman.append(Edge(nodedictionary.get(str(edges[i][0])),nodedictionary.get(str(edges[i][1])),edges[i][2]))
                edges_bellman.append(Edge(nodedictionary.get(str(edges[i][1])),nodedictionary.get(str(edges[i][0])),edges[i][2]))

        else :
             file = open("ggRoad.txt","w+")
             cord2 = ['2,2']
             for i in range(len(cord2)):
                 file.write(cord2[i])
                 if(i==len(cord2)-1):
                     break
                 file.write("\n")
             file.close()
    def parseInputSpace(self):
        a = user_input[1].split(" ")
        new = ""
        for i in range(len(a)):
            new += a[i]

        user_input[1] = new
        print(user_input[1])
        a = user_input[2].split(" ")
        new = ""
        for i in range(len(a)):
            new += a[i]

        user_input[2] = new
        print(user_input[2])



algo = Algorithms()
today = date.today()
user_input = []


ggList = [
 ("MRTBlokM","BlokMPlaza"),
 ("BlokMPlaza","PLN"),
 ("PLN","MRTAsean"),
 ("MRTAsean","Sisingamaraja"),
 ("Sisingamaraja","BunderanSenayan"),
 ("BunderanSenayan","FXSudirman"),
 ("FXSudirman","CIMBNiaga"),
 ("CIMBNiaga","PacificPlace"),
 ("PacificPlace","SudirmanSBD"),
 ("SudirmanSBD","PlazaSemanggi"),
 ("PlazaSemanggi","Atmajaya"),
 ("Atmajaya","SampoernaStrategic"),
 ("SampoernaStrategic","SetiabudiAstra"),
 ("SetiabudiAstra","IndofoodTower"),
 ("IndofoodTower","Jl.M.H.Thamrin"),
 ("Jl.M.H.Thamrin","DukuhAtas"),
 ("DukuhAtas","UOB"),
 ("UOB","BunderanHI"),
 ("BunderanHI","BPPRI"),
 ("BPPRI","BankIndonesia"),
 ("BankIndonesia","Monas"),
 ("Monas",""),
]

ggList2 = [
 ("AnggrekGaruda","S.Parman"),
 ("S.Parman","JDC"),
 ("JDC","BPK"),
 ("BPK","DPR/MPR"),
 ("DPR/MPR","BalaiSidang"),
 ("BalaiSidang","SultanHotel"),
 ("SultanHotel","SudirmanSBD"),
 ("SudirmanSBD","PoldaMetro"),
 ("PoldaMetro","SamsatJakarta"),
 ("SamsatJakarta","BPJS"),
 ("BPJS","HotelKartika"),
 ("HotelKartika","TelkomselTower"),
 ("TelkomselTower","BalaiKartini"),
 ("BalaiKartini","GatotSubroto"),
 ("GatotSubroto","ParamadinaUniv."),
 ("ParamadinaUniv.","Medistra"),
 ("Medistra","AllFresh"),
 ("AllFresh","Pancoran"),
 ("Pancoran",""),
]

ggList3 = [
 ("PoldaMetro","PlazaSemanggi"),
 ("PlazaSemanggi","SultanHotel"),
 ("SultanHotel","PacificPlace"),
 ("PacificPlace","PoldaMetro"),
 ("PoldaMetro",""),
]

ggList4 = [
 ("Jl.Galunggung","HouseRooftop"),
 ("HouseRooftop","AllunaTower"),
 ("AllunaTower","Setiabudi"),
 ("Setiabudi","PlazaFestival"),
 ("PlazaFestival","TrowonganCasablanca"),
 ("TrowonganCasablanca","GedungGranadi"),
 ("GedungGranadi","SingaporeEmbassy"),
 ("SingaporeEmbassy","GatotSubroto"),
 ("GatotSubroto",""),
]

def createBellman():
    global nodedictionary
    global points
    global edges
    global edges_bellman
    global nodelist_bellman
    nodedictionary = {}
    points = {}
    for l in coor.read().split("\n"):
        raw = l.split(" ")
        nodedictionary[raw[0]] = Node(raw[0])
        points[raw[0]] = raw[1]
    nodelist_bellman = []
    for i in nodedictionary:
        nodelist_bellman.append(nodedictionary.get(i))

    edges = []
    edges_bellman = []

    for line in file.read().split("\n"):
        raw = line.split(" ")
        edges.append((raw[0], raw[1], int(raw[2])))
        edges_bellman.append(Edge(nodedictionary.get(str(raw[0])),nodedictionary.get(str(raw[1])),int(raw[2])))
        edges_bellman.append(Edge(nodedictionary.get(str(raw[1])),nodedictionary.get(str(raw[0])),int(raw[2])))
    file.close()



def detganjilgenap():
    global go
    global todate
    global todayformat
    global uiformat
    todate = today.strftime("%B %d, %Y")
    print("d2 =", todate)
    date = today.strftime("%d")
    print(user_input[0])
    print(int(date) % int(user_input[0]))


    go = False
    todayformat = ""
    uiformat = ""
    if (int(date)) % 2 == 0:
        todayformat = "Even"
    else:
        todayformat = "Odd"

    if user_input[0] == "1":
        uiformat = "Odd"
    else:
        uiformat ="Even"

    if todayformat != uiformat:
        go = True

def main():
    global file
    global fileRes
    global coor
    global fileedge
    file = open("user_input.txt", "r")
    for line in file.read().split("\n"):
        user_input.append(line)
    fileRes = open("result.txt","w+")
    file1 = open("fastest_route.txt","w+")
    coor = open("coordinates.txt", "r")
    file = open("edges.txt", "r")

    algo.parseInputSpace()
    createBellman()
    algo.reverse(edges)
    detganjilgenap()


    algo.ganjilgenap()

    start = timeit.default_timer()
    algo.Bellman(nodelist_bellman,edges_bellman,nodedictionary.get(user_input[1]),nodedictionary.get(user_input[2]))
    timeb = timeit.default_timer() - start
    path_bellman.reverse()
    print("PATH BELLMAN : \n",path_bellman)

    start = timeit.default_timer()
    algo.dijkstra(edges, user_input[1], user_input[2])
    time = timeit.default_timer() - start
    dijkstraExc = round(time,6)
    bellmanExc = round(timeb,6)
    faster = ""

    if(dijkstraExc < bellmanExc):
        faster = "Dijkstra's Algorithm "
    else:
        faster = "Bellman Algorithm "

    print("Time Taken BELLMAN:", bellmanExc)
    print("Time Taken DIJKSTRA:", dijkstraExc)


    if(algo.path1[-1] != user_input[2]):
        plateNum = ""
        if(user_input[0] == '1'):
            plateNum = "Odd"
        else:
            plateNum = "Even"
        file1.write("0.0")
        file1.write("\n")
        file1.close()
        r = []
        r.append("None")
        r.append("None")
        r.append("None")
        r.append("None")
        r.append(str(plateNum))
        r.append(str(todate))
        for i in range(len(r)):
            fileRes.write(r[i])
            if(i==len(r)- 1):
                break
            fileRes.write("\n")

    else:
        plateNum = ""
        if(user_input[0] == '1'):
            plateNum = "Odd"
        else:
            plateNum = "Even"
        print('Total Distance : ' , algo.cost1)
        cord = []
        result = []
        result.append(str(algo.cost1))
        result.append(str(dijkstraExc))
        result.append(str(bellmanExc))
        result.append(str(faster))
        result.append(str(plateNum))
        result.append(str(todate))
        print(algo.path1)
        print(result)
        for i in range(len(algo.path1)):
            cord.append(points.get(algo.path1[i]))
        for i in range(len(cord)):
            file1.write(cord[i])
            if(i==len(cord)-1):
                break
            file1.write("\n")
        file1.close()
        print(len(result))
        for i in range(len(result)):
            fileRes.write(result[i])
            if(i==len(result)- 1):
                break
            fileRes.write("\n")
        fileRes.close()

if __name__ == '__main__':
        main()
