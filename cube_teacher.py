#!/bin/env python
#coding:gbk

import time
import copy
import math

class Block:
    def __init__(self, name, ic, jc, kc, x, y, z, i, j, k): 
        self._name = name
        self._ic = ic
        self._jc = jc
        self._kc = kc
        self._x = x
        self._y = y
        self._z = z
        self._tx = x
        self._ty = y
        self._tz = z
        self._i = i
        self._j = j
        self._k = k
        self._ti = i
        self._tj = j
        self._tk = k
        self._type = "corner"
        if x == 0 or y == 0 or z == 0:
            self._type = "side"

    def is_recover(self):
        if self._x == self._tx and self._y == self._ty and self._z == self._tz and \
        self._i == self._ti and self._j == self._tj and self._k == self._tk:
            return True

    def get_x(self):
        return self._x

    def get_y(self):
        return self._y

    def get_z(self):
        return self._z
        
    def get_k(self):
        return self._k
        
    def get_h(self):
        return math.floor(math.sqrt((self._x-self._tx)*(self._x-self._tx)+(self._y-self._ty)*(self._y-self._ty)+(self._z-self._tz)*(self._z-self._tz)))

    def get_name(self):
        return self._name
           
    def get_color(self, face): 
        if self._i == face:
            return self._ic
        if self._j == face:
            return self._jc
        if self._k == face:
            return self._kc
        return "N"

    def do_trans(self, face):
        if face == "F" and self._x == 1:
            return True
        if face == "B" and self._x == -1:
            return True

        if face == "R" and self._y == 1:
            return True
        if face == "L" and self._y == -1:
            return True

        if face == "U" and self._z == 1:
            return True
        if face == "D" and self._z == -1:
            return True

        return False

    def right_hand_process(self, face):
        if face == "F" or face == "B":
            self._j, self._k = self._k, self._j
            self._jc, self._kc = self._kc, self._jc
            
        if face == "R" or face == "L":
            self._i, self._k = self._k, self._i
            self._ic, self._kc = self._kc, self._ic
            
        if face == "U" or face == "D":
            self._i, self._j = self._j, self._i
            self._ic, self._jc = self._jc, self._ic


    def turn_transform(self, face, _trans_matrix):
        if self.do_trans(face):
            pos_matrix = _trans_matrix["pos"]
            ori_matrix = _trans_matrix["ori"]
        
            #pos transform
            x = self._x
            y = self._y
            z = self._z
            
            self._x = pos_matrix[0][0] * x + pos_matrix[0][1] * y + pos_matrix[0][2] * z;
            self._y = pos_matrix[1][0] * x + pos_matrix[1][1] * y + pos_matrix[1][2] * z;
            self._z = pos_matrix[2][0] * x + pos_matrix[2][1] * y + pos_matrix[2][2] * z;

            #ori transform
            i = self._i
            j = self._j
            k = self._k

            #mirror process
            iFlag = 1
            jFlag = 1
            kFlag = 1
            if i < 0 :
                i = i * -1
                iFlag = -1
            if j < 0 :
                j = j * -1
                jFlag = -1
            if k < 0 :
                k = k * -1
                kFlag = -1

            self._i = (ori_matrix[0][0] * i + ori_matrix[0][1] * j + ori_matrix[0][2] * k) * iFlag;
            self._j = (ori_matrix[1][0] * i + ori_matrix[1][1] * j + ori_matrix[1][2] * k) * jFlag;
            self._k = (ori_matrix[2][0] * i + ori_matrix[2][1] * j + ori_matrix[2][2] * k) * kFlag;

            #right hand process
            self.right_hand_process(face) 

class MagicCube:
    def __init__(self, cross_cube = False):
        self._block = []

        #add corner
        self._block.append(Block("RGY", "R", "G", "Y", 1, 1, 1, 1, 2, 3))
        self._block.append(Block("OGY", "O", "G", "Y", -1, 1, 1, -1, 2, 3))
        self._block.append(Block("RBY", "R", "B", "Y", 1, -1, 1, 1, -2, 3))
        self._block.append(Block("OBY", "O", "B", "Y", -1, -1, 1, -1, -2, 3))
        self._block.append(Block("RGW", "R", "G", "W", 1, 1, -1, 1, 2, -3))
        self._block.append(Block("OGW", "O", "G", "W", -1, 1, -1, -1, 2, -3))
        self._block.append(Block("RBW", "R", "B", "W", 1, -1, -1, 1, -2, -3))
        self._block.append(Block("OBW", "O", "B", "W", -1, -1, -1, -1, -2, -3))
        #add side
        self._block.append(Block("NGY", "N", "G", "Y", 0, 1, 1, 1, 2, 3))
        self._block.append(Block("NBY", "N", "B", "Y", 0, -1, 1, 1, -2, 3))
        self._block.append(Block("NGW", "N", "G", "W", 0, 1, -1, 1, 2, -3))
        self._block.append(Block("NBW", "N", "B", "W", 0, -1, -1, 1, -2, -3))
        
        self._block.append(Block("RNY", "R", "N", "Y", 1, 0, 1, 1, 2, 3))
        self._block.append(Block("ONY", "O", "N", "Y", -1, 0, 1, -1, 2, 3))
        self._block.append(Block("RNW", "R", "N", "W", 1, 0, -1, 1, 2, -3))
        self._block.append(Block("ONW", "O", "N", "W", -1, 0, -1, -1, 2, -3))

        self._block.append(Block("RGN", "R", "G", "N", 1, 1, 0, 1, 2, 3))
        self._block.append(Block("OGN", "O", "G", "N", -1, 1, 0, -1, 2, 3))
        self._block.append(Block("RBN", "R", "B", "N", 1, -1, 0, 1, -2, 3))
        self._block.append(Block("OBN", "O", "B", "N", -1, -1, 0, -1, -2, 3))

        #init display matrix
        self._display_matrix = {}
        self._display_matrix["F"] = [["R","R","R"],["R","R","R"],["R","R","R"]]
        self._display_matrix["B"] = [["O","O","O"],["O","O","O"],["O","O","O"]]
        self._display_matrix["R"] = [["G","G","G"],["G","G","G"],["G","G","G"]]
        self._display_matrix["L"] = [["B","B","B"],["B","B","B"],["B","B","B"]]
        self._display_matrix["U"] = [["Y","Y","Y"],["Y","Y","Y"],["Y","Y","Y"]]
        self._display_matrix["D"] = [["W","W","W"],["W","W","W"],["W","W","W"]]

        #init _trans_matrix
        self._trans_matrix = {}
        self._trans_matrix["x"] = {"pos":[[1,0,0],[0,0,1],[0,-1,0]], "ori":[[1,0,0],[0,0,-1],[0,1,0]]}
        self._trans_matrix["y"] = {"pos":[[0,0,-1],[0,1,0],[1,0,0]], "ori":[[0,0,1],[0,1,0],[-1,0,0]]}
        self._trans_matrix["z"] = {"pos":[[0,1,0],[-1,0,0],[0,0,1]], "ori":[[0,-1,0],[1,0,0],[0,0,1]]}

        self._trans_matrix["-x"] = {"pos":[[1,0,0],[0,0,-1],[0,1,0]], "ori":[[1,0,0],[0,0,1],[0,-1,0]]}
        self._trans_matrix["-y"] = {"pos":[[0,0,1],[0,1,0],[-1,0,0]], "ori":[[0,0,-1],[0,1,0],[1,0,0]]}
        self._trans_matrix["-z"] = {"pos":[[0,-1,0],[1,0,0],[0,0,1]], "ori":[[0,1,0],[-1,0,0],[0,0,1]]}

        self.turn_time = 0

    def to_cross_cube(self):
        cross_block_name = ["RNW", "ONW", "NGW", "NBW"] 
        tmp_block = []
        for b in self._block:
            if b.get_name() in cross_block_name:
                tmp_block.append(b)
        self._block = tmp_block

    def find_block_by_name(self, name):
        for b in self._block:
            if name == b.get_name():
                return b

    def get_block_list(self):
        return self._block

    def gen_display_matrix(self):
        #get face F
        for b in self._block:
            if b.get_x() == 1:
                self._display_matrix["F"][1-b.get_z()][b.get_y()+1] = b.get_color(1) 
 
        #get face B
        for b in self._block:
            if b.get_x() == -1:
                self._display_matrix["B"][b.get_z()+1][b.get_y()+1] = b.get_color(-1) 
            
        #get face R
        for b in self._block:
            if b.get_y() == 1:
                self._display_matrix["R"][1-b.get_z()][1-b.get_x()] = b.get_color(2) 
 
        #get face L
        for b in self._block:
            if b.get_y() == -1:
                self._display_matrix["L"][b.get_z()+1][1-b.get_x()] = b.get_color(-2) 
 
        #get face U
        for b in self._block:
            if b.get_z() == 1:
                self._display_matrix["U"][b.get_x()+1][b.get_y()+1] = b.get_color(3) 
 
        #get face D
        for b in self._block:
            if b.get_z() == -1:
                self._display_matrix["D"][1-b.get_y()][1-b.get_x()] = b.get_color(-3) 
 
    def print_face(self, face):
        print "face: ", face
        for c in self._display_matrix[face]:
            print c[0], " ", c[1], " ", c[2]
        print "" 
        
    def print_cube(self):
        self.gen_display_matrix()
        self.print_face("U")
        self.print_face("F")
        self.print_face("R")
        self.print_face("D")
        self.print_face("L")
        self.print_face("B")

    def turn(self, action):
        start = time.clock()
        face = ""
        axis = ""
        if action == "F":
            face = "F"
            axis = "x"
       
        if action == "F'":
            face = "F"
            axis = "-x"

        if action == "R":
            face = "R"
            axis = "y"
 
        if action == "R'":
            face = "R"
            axis = "-y"
 
        if action == "U":
            face = "U"
            axis = "z"
                
        if action == "U'":
            face = "U"
            axis = "-z"
 
        if action == "B'":
            face = "B"
            axis = "x"
       
        if action == "B":
            face = "B"
            axis = "-x"

        if action == "L'":
            face = "L"
            axis = "y"
 
        if action == "L":
            face = "L"
            axis = "-y"
                
        if action == "D'":
            face = "D"
            axis = "z"
                
        if action == "D":
            face = "D"
            axis = "-z"
 
        for b in self._block:
            b.turn_transform(face, self._trans_matrix[axis])
            
        self.turn_time = self.turn_time + (time.clock() - start) 
 
class CubeOperator:
    def __init__(self, cube):
        self._cube = cube

    def execute_formula(self, formula):
        print "formula :", formula
        for f in formula.split(' '):
            if f[0] == "2":
                self._cube.turn(f[1])
                self._cube.turn(f[1])
            else:
                self._cube.turn(f)
                
class CubeResolver:
    def __init__(self, cube):
        self._cube = cube
        self._status = "init"
        self._formula_set = ["F","F'","B","B'","R","R'","L","L'","U","U'","D","D'"]
        self._formula_unti_set = ["F'","F","B'","B","R'","R","L'","L","U'","U","D'","D"]
        self._formula_stack = []
        self.cut_count = 0
        self._resolver_condition = {}
        self._resolver_condition["first_cross"] = ["RNW", "ONW", "NGW", "NBW"]

    def resolver_done(self, step = "all"):
        for b in self._cube.get_block_list():
            if step == "all" or b.get_name() in self._resolver_condition[step] and not b.is_recover() :
                return False
        return True

    def can_not_move(self, formula, step):
        for block_name in self._resolver_condition[step]:
            block = self._cube.find_block_by_name(block_name)
            if block.do_trans(formula[0]):
                return False
        return True

    def get_h(self):
        sum = 0
        for b in self._cube.get_block_list():
            if b.get_z() == -1:
                sum = sum + b.get_h()*0.25
            else:
                sum = sum + b.get_h()
        
        return sum

    def depth_first_search(self, depth, max_depth, step):
       
        if self.resolver_done(step):
            print "resolver done"
            return True
            
        #cut branch 1
        if depth + 1 > max_depth:
            return False
    
        for i in range(len(self._formula_set)):
            #cut branch 1, can't move the target block
            if self.can_not_move(self._formula_set[i], step):
                continue
 
            #cut branch 2, unti turn, such as "R R' "
            if depth > 1 and self._formula_set[i][0] == self._formula_stack[-1][0] and len(self._formula_set[i]) <> len(self._formula_stack[-1]):
                #print "cut brach:", self._formula_stack, self._formula_set[i]
                continue

            #cut branch 3, repeat same turn 3 times, such as "R R R"
            if depth > 2 and self._formula_set[i] == self._formula_stack[-1] and self._formula_set[i] == self._formula_stack[-2]:
                #print "cut brach:", self._formula_stack, self._formula_set[i]
                continue 

            #cut branch 3
            #if depth >5 and self.get_h() > 2:
                #continue

            self._cube.turn(self._formula_set[i])
            self._formula_stack.append(self._formula_set[i])
            
            #tmp_cube = copy.deepcopy(self._cube)
            if self.depth_first_search(depth+1, max_depth, step):
                return True
            else:
                #self._cube = copy.deepcopy(tmp_cube)
                self._cube.turn(self._formula_unti_set[i])
                self._formula_stack.pop()

        return False
    
    def resolver_all(self):
        pass 

    def resolver_step(self, step):
        self._formula_stack = []

        for max_depth in range(1, 8):
            print "max_depth: ", max_depth
            if self.depth_first_search(0, max_depth, step):
                break;
   
        print "turn time: ", self._cube.turn_time
        return self._formula_stack 
    
if __name__ == "__main__":
    magic_cube = MagicCube()

    cubeOpt = CubeOperator(magic_cube)
    cubeOpt.execute_formula("D R F' D 2L U R' 2D L'")
    
    magic_cube_cross = copy.deepcopy(magic_cube)
    magic_cube_cross.to_cross_cube()
    
    cubeRsl = CubeResolver(magic_cube_cross)
    start = time.clock()
    print cubeRsl.resolver_step("first_cross")
    elapsed = (time.clock() - start)


    #magic_cube.print_cube()


    print "title time: ", elapsed
