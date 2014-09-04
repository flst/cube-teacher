#coding: UTF-8
from pearson_distance import pearson_distance
import math 
import random 
import __main__

def print_matchs(matchs, pixel) : 
    #corect classify
    correct = [3,0,2,1,5,2,4,4,3,5,3,0,2,1,1,1,3,2,2,1,5,2,2,3,4,0,5,4,5,1,3,4,4,3,4,2,3,0,0,5,3,1,1,5,1,4,2,0,5,0,4,5,0,0]
    color = ["orange","red","green","blue","white","yellow"]
    for i in range(len(matchs)) : 
        print color[i], "\t" , '---->' 
        for item in matchs[i] : 
            print item, "(", pixel[item],")",
            if correct[item] <> i:
                print "->", color[correct[item]]
            else:
                print 
        print 
    print '-'*20

def kmeans(blogwords, k,clusters) : 
    lables = [] 
    matchs = [ [] for i in range(k)] 
    lastmatchs = [ [] for i in range(k)] 
    
    rounds = 100
    while rounds > 0 : 
        matchs = [ [] for i in range(k)] 
        print 'round \t',rounds 
        for i in range(len(blogwords)) : 
            bestmatch_cluster = None
            min_distance = 100
            for j in range(k) :  
                #dis = math.sqrt((clusters[j][0] - blogwords[i][0]) * (clusters[j][0] - blogwords[i][0]) + \
                #    (clusters[j][1] - blogwords[i][1]) * (clusters[j][1] - blogwords[i][1]) +\
                #    (clusters[j][2] - blogwords[i][2]) * (clusters[j][2] - blogwords[i][2]))
                dis = pearson_distance(clusters[j], blogwords[i])
#                 print dis 
                if dis < min_distance : 
                    min_distance = dis 
                    bestmatch_cluster = j        
            matchs[bestmatch_cluster].append(i)  
        #print_matchs(matchs) 
        #print_matchs(lastmatchs) 
        if matchs == lastmatchs : break 
#         if len(matchs[0]) == 6 and len(matchs[1]) == 6 and len(matchs[2]) == 6 and len(matchs[3]) == 6 and len(matchs[4])== 6 : break
        lastmatchs = [[ item for item in matchs[i] ] for i in range(k)] 
        #move the centroids to the average of their members 
        for j in range(k) : 
            avg = [0.0 for i in range(len(blogwords[0])) ]  
            for m in matchs[j] : 
                vec = blogwords[m] 
                for i in range(len(blogwords[0])) : 
                    avg[i] += vec[i] 
            if len(matchs[j]) == 0 :
                continue
            avg = [ item / len(matchs[j]) for item in avg]  
            clusters[j] = avg 
        rounds -= 1
    return matchs
if __name__ == "__main__":
#     print kmeans([[229, 79, 98], [251, 164, 108], [82, 90, 208], 
#                   [231, 234, 235], [252, 174, 110], [252, 255, 255], 
#                   [252, 255, 255], [251, 254, 254], [252, 255, 255],
#                   [130, 186, 60], [19, 143, 81], [50, 51, 117], 
#                   [104, 37, 46], [101, 28, 35], [174, 52, 33], 
#                   [113, 174, 51], [169, 55, 34], [122, 141, 164], 
#                   [77, 52, 61], [81, 56, 64],[49, 61, 85],
#                   [25, 29, 45], [13, 66, 28], [62, 77, 18], 
#                   [92, 38, 38], [71, 69, 70], [45, 19, 20]] , 6)
    input_pixel = [[56, 74, 160], [253, 97, 82], [48, 218, 92], [185, 55, 72], [239, 254, 86], [37, 219, 101], [230, 237, 251], [228, 236, 249], [69, 100, 167],
        [176, 185, 81], [75, 74, 116], [222, 72, 71], [74, 149, 80], [143, 64, 70], [141, 61, 66], [151, 86, 87], [88, 92, 121], [79, 153, 91], 
        [61, 159, 84], [152, 87, 95], [183, 198, 98], [64, 153, 77], [62, 156, 75], [99, 106, 128], [171, 170, 168], [227, 85, 73], [173, 185, 73],
        [224, 232, 248], [232, 254, 78], [186, 81, 94], [46, 72, 164], [120, 128, 147], [226, 234, 247], [50, 75, 167], [222, 234, 250], [34, 216, 104],
        [90, 95, 127], [222, 77, 80], [219, 72, 75], [176, 185, 80], [85, 81, 117], [146, 67, 72], [152, 92, 91], [182, 190, 90], [153, 88, 89], 
        [175, 172, 179], [77, 161, 101], [235, 112, 105], [183, 192, 72], [234, 91, 85], [179, 178, 178], [179, 189, 71], [231, 85, 77], [228, 90, 84]]
    cluster = [[152, 92, 91],[219, 72, 75],[77, 161, 101],[90, 95, 127],[222, 234, 250],[232, 254, 78]]                     
    #linenars
    for p in input_pixel:
        max_p = max(p)
        ratio = 255.0/max_p
        p[0] = round(p[0] * ratio)
        p[1] = round(p[1] * ratio)
        p[2] = round(p[2] * ratio)
    
    #linenars
    for p in cluster:
        max_p = max(p)
        ratio = 255.0/max_p
        p[0] = round(p[0] * ratio)
        p[1] = round(p[1] * ratio)
        p[2] = round(p[2] * ratio)
 
    
    print_matchs( kmeans(input_pixel , 6, cluster), input_pixel)
    
