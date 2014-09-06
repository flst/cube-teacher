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
        if abs(x) + abs(y) + abs(z) == 1:
            self._type = "centre" 

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
        
    def get_tx(self):
        return self._tx

    def get_ty(self):
        return self._ty

    def get_tz(self):
        return self._tz
 
    def get_i(self):
        return self._i

    def get_j(self):
        return self._j

    def get_k(self):
        return self._k
        
    def get_ti(self):
        return self._ti

    def get_tj(self):
        return self._tj

    def get_tk(self):
        return self._tk
        
    def get_type(self):
        return self._type

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
        
    def get_iorj_color(self): 
        if self._ic <> "N":
            return self._ic
        if self._jc <> "N":
            return self._jc
        return "N"
 
        
    def get_face(self, color): 
        if self._ic == color:
            return self._i
        if self._jc == color:
            return self._j
        if self._kc == color:
            return self._k
        return "n"

    def do_trans(self, face):
        if face[0] == "A":
            return True
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
        if face == "F" or face == "B" or face == "AF":
            self._j, self._k = self._k, self._j
            self._jc, self._kc = self._kc, self._jc
            
        if face == "R" or face == "L" or face == "AR":
            self._i, self._k = self._k, self._i
            self._ic, self._kc = self._kc, self._ic
            
        if face == "U" or face == "D" or face == "AU":
            self._i, self._j = self._j, self._i
            self._ic, self._jc = self._jc, self._ic

        if face[0] == "A":
            if face[1] == "F":
                self._tj, self._tk = self._tk, self._tj
            if face[1] == "R":
                self._ti, self._tk = self._tk, self._ti
            if face[1] == "U":
                self._ti, self._tj = self._tj, self._ti


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

            #target pos transform
            if face[0] == "A": 
                tx = self._tx
                ty = self._ty
                tz = self._tz
            
                self._tx = pos_matrix[0][0] * tx + pos_matrix[0][1] * ty + pos_matrix[0][2] * tz;
                self._ty = pos_matrix[1][0] * tx + pos_matrix[1][1] * ty + pos_matrix[1][2] * tz;
                self._tz = pos_matrix[2][0] * tx + pos_matrix[2][1] * ty + pos_matrix[2][2] * tz;


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

            if face[0] == "A": 
                #ori transform
                ti = self._ti
                tj = self._tj
                tk = self._tk

                #mirror process
                tiFlag = 1
                tjFlag = 1
                tkFlag = 1
                if ti < 0 :
                    ti = ti * -1
                    tiFlag = -1
                if tj < 0 :
                    tj = tj * -1
                    tjFlag = -1
                if tk < 0 :
                    tk = tk * -1
                    tkFlag = -1

                self._ti = (ori_matrix[0][0] * ti + ori_matrix[0][1] * tj + ori_matrix[0][2] * tk) * tiFlag;
                self._tj = (ori_matrix[1][0] * ti + ori_matrix[1][1] * tj + ori_matrix[1][2] * tk) * tjFlag;
                self._tk = (ori_matrix[2][0] * ti + ori_matrix[2][1] * tj + ori_matrix[2][2] * tk) * tkFlag;


            #right hand process
            self.right_hand_process(face) 

class MagicCube:
    def __init__(self, cross_cube = False):
        self._block = []

        #add centre
        self._block.append(Block("RNN", "R", "N", "N", 1, 0, 0, 1, 2, 3))
        self._block.append(Block("ONN", "O", "N", "N", -1, 0, 0, -1, 2, 3))
        self._block.append(Block("NGN", "N", "G", "N", 0, 1, 0, 1, 2, 3))
        self._block.append(Block("NBN", "N", "B", "N", 0, -1, 0, 1, -2, 3))
        self._block.append(Block("NNY", "N", "N", "Y", 0, 0, 1, 1, 2, 3))
        self._block.append(Block("NNW", "N", "N", "W", 0, 0, -1, 1, 2, -3))

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

    def get_centre_block(self, color):
        for b in self._block:
            if b.get_type() == "centre" and color in b.get_name():
                return b
        return ""

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
        #start = time.clock()
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

        if action == "y":
            face = "AU"
            axis = "z"
       
        if action == "y'":
            face = "AU"
            axis = "-z"

        if action == "x":
            face = "AR"
            axis = "y"
       
        if action == "x'":
            face = "AR"
            axis = "-y"

        #print face, axis
        for b in self._block:
            b.turn_transform(face, self._trans_matrix[axis])
            
        #self.turn_time = self.turn_time + (time.clock() - start) 
 
 
class CubeOperator:
    def __init__(self, cube):
        self._cube = cube

    def execute_formula(self, formula):
        print "formula :", formula
        for f in formula:
            if len(f) == 2 and f[1] == "2":
                self._cube.turn(f[0])
                self._cube.turn(f[0])
            else:
                self._cube.turn(f)
 
    def execute_formula_by_string(self, formula_string):
        print "formula :", formula_string
        for f in formula_string.split(' '):
            if len(f) == 2 and f[1] == "2":
                self._cube.turn(f[0])
                self._cube.turn(f[0])
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
        self._resolver_condition["first_cross"] = ["RNW"]
        self._resolver_condition["secend_cross"] = ["RNW", "ONW"]
        self._resolver_condition["third_cross"] = ["RNW", "ONW", "NGW"]
        self._resolver_condition["fouth_cross"] = ["RNW", "ONW", "NGW", "NBW"]
        self._resolver_condition["1st_corner"] = ["RGW", "OGW", "RBW", "OBW"]
        self._resolver_condition["2st_side"] = ["RGN", "OGN", "RBN", "OBN"]

    def execute_formula(self, formula):
        #print "formula :", formula
        for f in formula:
            if len(f) == 2 and f[1] == "2":
                self._cube.turn(f[0])
                self._cube.turn(f[0])
            else:
                self._cube.turn(f)
 
    def execute_formula_by_string(self, formula_string):
        #print "formula :", formula_string
        for f in formula_string.split(' '):
            if len(f) == 2 and f[1] == "2":
                self._cube.turn(f[0])
                self._cube.turn(f[0])
            else:
                self._cube.turn(f)
 
    def resolver_done(self, step = "all"):
            
        for b in self._cube.get_block_list():
            if step == "all":
                if not b.is_recover():
                    return False
            else:
                if b.get_name() in self._resolver_condition[step] and not b.is_recover() :
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
            #print "resolver done"
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
    

    def resolver_1st_corner(self):
        while not self.resolver_done("1st_corner"):
            #find
            formula_set = ["U", "U'", "U2"]
            formula_unti_set = ["U'", "U", "U2"]
            
            axis_formula_set = ["y", "y'", "y2"]
            axis_formula_unti_set = ["y'", "y", "y2"]
            find_in_3st = False
            block = ""
            #set
            set_formula = []
 
            #find at 3st layer 
            for b in self._cube.get_block_list():
                if b.get_type() == "corner" and b.get_z() == 1 and 'W' in b.get_name():
                    find_in_3st = True
                    block = b
                    break
                    #print b.get_name(), b.get_x(), b.get_y(), b.get_z(), block.get_tx(), block.get_ty(), block.get_tz()
            if not find_in_3st:
                for b in self._cube.get_block_list():
                    if b.get_type() == "corner" and b.get_z() == -1 and 'W' in b.get_name() and not b.is_recover():
                        block = b
                        break 
                        
                #set axis y ori
                for i in range(len(axis_formula_set)):
                    self.execute_formula_by_string(axis_formula_set[i])
                    #print block.get_name(), block.get_x(), block.get_y(), block.get_z(), block.get_tx(), block.get_ty(), block.get_tz()
                    if block.get_x() == 1 and block.get_y() == 1:
                        set_formula.append(axis_formula_set[i])
                        break
                    self.execute_formula_by_string(axis_formula_unti_set[i])
            
                set_formula.append("R")
                set_formula.append("U")
                set_formula.append("R'")
                self.execute_formula(["R", "U", "R'"])    

         
            #set axis y ori
            for i in range(len(axis_formula_set)):
                self.execute_formula_by_string(axis_formula_set[i])
                #print block.get_name(), block.get_x(), block.get_y(), block.get_z(), block.get_tx(), block.get_ty(), block.get_tz()
                if block.get_tx() == 1 and block.get_ty() == 1:
                    set_formula.append(axis_formula_set[i])
                    break
                self.execute_formula_by_string(axis_formula_unti_set[i])

            #set 3st pos
            for i in range(len(formula_set)):
                self.execute_formula_by_string(formula_set[i])
                #print block.get_name(), block.get_x(), block.get_y(), block.get_z(), block.get_tx(), block.get_ty(), block.get_tz()
                if block.get_x() == block.get_tx() and block.get_y() == block.get_ty():
                    set_formula.append(formula_set[i])
                    break
                self.execute_formula_by_string(formula_unti_set[i])

            print "corner block: ", block.get_name(), " set formula: ", set_formula

            #execute
            exe_formula = []
            face = block.get_face("W")
            if face == 1:
                exe_formula = ["U", "R", "U'", "R'"]

            if face == 2:
                exe_formula = ["R", "U", "R'"]

            if face == 3:
                exe_formula = ["R", "U2", "R'", "U'", "R", "U", "R'"]
                
            self.execute_formula(exe_formula)
            print "execute: ", exe_formula

            #set
            #if cnt == 4:
                #break

            #excute

    def resolver_2st_side(self):
        while not self.resolver_done("2st_side"):
            #find
            formula_set = ["U", "U'", "U2"]
            formula_unti_set = ["U'", "U", "U2"]
            
            axis_formula_set = ["y", "y'", "y2"]
            axis_formula_unti_set = ["y'", "y", "y2"]
            find_in_3st = False
            block = ""
            #set
            set_formula = []
 
            #find at 3st layer 
            for b in self._cube.get_block_list():
                if b.get_type() == "side" and b.get_z() == 1 and 'Y' not in b.get_name():
                    find_in_3st = True
                    block = b
                    break
                    #print b.get_name(), b.get_x(), b.get_y(), b.get_z(), block.get_tx(), block.get_ty(), block.get_tz()
            if not find_in_3st:
                for b in self._cube.get_block_list():
                    if b.get_type() == "side" and b.get_z() == 0 and 'Y' not in b.get_name() and not b.is_recover():
                        block = b
                        break 
                        
                #set axis y ori
                for i in range(len(axis_formula_set)):
                    self.execute_formula_by_string(axis_formula_set[i])
                    #print block.get_name(), block.get_x(), block.get_y(), block.get_z(), block.get_tx(), block.get_ty(), block.get_tz()
                    if block.get_x() == 1 and block.get_y() == 1:
                        set_formula.append(axis_formula_set[i])
                        break
                    self.execute_formula_by_string(axis_formula_unti_set[i])
            
                set_formula.append("U R U' R' U' F' U F")
                self.execute_formula_by_string("U R U' R' U' F' U F")    

         
            #set axis y ori
            iorj_color = block.get_iorj_color()
            target_centre_block = self._cube.get_centre_block(iorj_color)
            
            for i in range(len(axis_formula_set)):
                self.execute_formula_by_string(axis_formula_set[i])
                #print block.get_name(), block.get_x(), block.get_y(), block.get_z(), block.get_tx(), block.get_ty(), block.get_tz()
                if target_centre_block.get_x() == 1:
                    set_formula.append(axis_formula_set[i])
                    break
                self.execute_formula_by_string(axis_formula_unti_set[i])

            #set 3st pos
            for i in range(len(formula_set)):
                self.execute_formula_by_string(formula_set[i])
                #print block.get_name(), block.get_x(), block.get_y(), block.get_z(), block.get_tx(), block.get_ty(), block.get_tz()
                if block.get_x() == 1:
                    set_formula.append(formula_set[i])
                    break
                self.execute_formula_by_string(formula_unti_set[i])

            print "side block: ", block.get_name(), " set formula: ", set_formula

            #execute
            exe_formula = []
            ty = block.get_ty()
            if ty == -1:
                exe_formula = "U' L' U L U F U' F'"

            if ty == 1:
                exe_formula = "U R U' R' U' F' U F"

                
            self.execute_formula_by_string(exe_formula)
            print "execute: ", exe_formula

            #set
            #if cnt == 4:
                #break

            #excute


    def resolver_3st_side_color(self):
        while True:
            block_list = []
            for b in self._cube.get_block_list():
                if b.get_z() == 1 and b.get_type() == "side" and  b.get_face("Y") == 3:
                    block_list.append(b)

            if len(block_list) == 4:
                break

               
            if len(block_list) == 2:
                if block_list[0].get_y() == 0 and block_list[0].get_y() == 0:
                    print "set formula: y"
                    self._cube.turn("y")
                if block_list[0].get_x() + block_list[0].get_y() + block_list[1].get_x() + block_list[1].get_y() == -2:
                    print "set formula: y2"
                    self._cube.turn("y")
                    self._cube.turn("y")
                if block_list[0].get_x() + block_list[0].get_y() + block_list[1].get_x() + block_list[1].get_y() == 0:
                    for b in block_list:
                        if b.get_y() == 0:
                            if b.get_x() == -1:
                                print "set formula: y"
                                self._cube.turn("y")
                            if b.get_x() == 1:
                                print "set formula: y'"
                                self._cube.turn("y'")

            exe_formula = "F R U R' U' F'"
            self.execute_formula_by_string(exe_formula)
            print "execute: ", exe_formula
 
    def resolver_3st_corner_color(self):
        while True:
            ok_block_list = []
            not_ok_block_list = []
            for b in self._cube.get_block_list():
                if b.get_z() == 1 and b.get_type() == "corner":
                    if b.get_face("Y") == 3:
                        ok_block_list.append(b)
                    else:
                        not_ok_block_list.append(b)

            if len(ok_block_list) == 4:
                break
            
            #find
            formula_set = ["U", "U'", "U2"]
            formula_unti_set = ["U'", "U", "U2"]
            
            axis_formula_set = ["y", "y'", "y2"]
            axis_formula_unti_set = ["y'", "y", "y2"]

            set_formula = []
               
            if len(ok_block_list) == 1:
                #set axis y ori
                for i in range(len(axis_formula_set)):
                    self.execute_formula_by_string(axis_formula_set[i])
                    if ok_block_list[0].get_x() == 1 and ok_block_list[0].get_y() == -1:
                        set_formula.append(axis_formula_set[i])
                        break
                    self.execute_formula_by_string(axis_formula_unti_set[i])

            if len(ok_block_list) == 2:
                if not_ok_block_list[0].get_face("Y") == not_ok_block_list[1].get_face("Y"):
                    #set axis y ori
                    for i in range(len(axis_formula_set)):
                        self.execute_formula_by_string(axis_formula_set[i])
                        if not_ok_block_list[0].get_face("Y") == 1:
                            set_formula.append(axis_formula_set[i])
                            break
                        self.execute_formula_by_string(axis_formula_unti_set[i])

                if not_ok_block_list[0].get_face("Y") == -1 * not_ok_block_list[1].get_face("Y"):
                    #set axis y ori
                    for i in range(len(axis_formula_set)):
                        self.execute_formula_by_string(axis_formula_set[i])
                        if abs(not_ok_block_list[0].get_face("Y")) == 1 and not_ok_block_list[0].get_y() == -1:
                            set_formula.append(axis_formula_set[i])
                            break
                        self.execute_formula_by_string(axis_formula_unti_set[i])

                if abs(not_ok_block_list[0].get_face("Y")) <> abs(not_ok_block_list[1].get_face("Y")):
                    #set axis y ori
                    for i in range(len(axis_formula_set)):
                        self.execute_formula_by_string(axis_formula_set[i])
                        if not_ok_block_list[0].get_face("Y") + not_ok_block_list[1].get_face("Y") == 3:
                            set_formula.append(axis_formula_set[i])
                            break
                        self.execute_formula_by_string(axis_formula_unti_set[i])
                        
            if len(ok_block_list) == 0:
                tmp_var = not_ok_block_list[0].get_face("Y") + not_ok_block_list[1].get_face("Y") + \
                not_ok_block_list[2].get_face("Y") + not_ok_block_list[3].get_face("Y")
                
                if tmp_var == 0:
                    if abs(not_ok_block_list[0].get_face("Y")) == 1:
                        self.execute_formula_by_string("y")
                        set_formula.append("y")
                else:
                    #get two same face block
                    cur_face = tmp_var / 2 
                    if cur_face == 1:
                        self.execute_formula_by_string("y")
                        set_formula.append("y")
                    
                    if cur_face == 2:
                        self.execute_formula_by_string("y2")
                        set_formula.append("y2")
                
                    if cur_face == -1:
                        self.execute_formula_by_string("y'")
                        set_formula.append("y'")

            print "set formula: ", set_formula

            exe_formula = "R U R' U R U2 R'"
            self.execute_formula_by_string(exe_formula)
            print "execute: ", exe_formula

    def resolver_3st_corner_pos(self):
        while True:
            block_list = []

            is_recover_count = 0;
            is_recover_b = ""
            is_recover_color = ""
            #find
            #corner ["RGY", "RBY", "OGY", "OBY"]
            if self._cube.find_block_by_name("RGY").get_face("R") == self._cube.find_block_by_name("RBY").get_face("R"):
                is_recover_count = is_recover_count + 1
                is_recover_b = self._cube.find_block_by_name("RGY")
                is_recover_color = "R"

            if self._cube.find_block_by_name("RGY").get_face("G") == self._cube.find_block_by_name("OGY").get_face("G"):
                is_recover_count = is_recover_count + 1
                is_recover_b = self._cube.find_block_by_name("RGY")
                is_recover_color = "G"
 
            if self._cube.find_block_by_name("RBY").get_face("B") == self._cube.find_block_by_name("OBY").get_face("B"):
                is_recover_count = is_recover_count + 1
                is_recover_b = self._cube.find_block_by_name("RBY")
                is_recover_color = "B"
 
            if self._cube.find_block_by_name("OGY").get_face("O") == self._cube.find_block_by_name("OBY").get_face("O"):
                is_recover_count = is_recover_count + 1
                is_recover_b = self._cube.find_block_by_name("OGY")
                is_recover_color = "O"
 
            formula_set = ["U", "U'", "U2"]
            formula_unti_set = ["U'", "U", "U2"]
            
            axis_formula_set = ["y", "y'", "y2"]
            axis_formula_unti_set = ["y'", "y", "y2"]

            set_formula = [] 
 
            #adjust
            if is_recover_count == 4:
                for i in range(len(formula_set)):
                    self.execute_formula_by_string(formula_set[i])
                    #print block.get_name(), block.get_x(), block.get_y(), block.get_z(), block.get_tx(), block.get_ty(), block.get_tz()
                    if self._cube.find_block_by_name("RGY").is_recover():
                        print "adjust: ", formula_set[i]
                        break
                    self.execute_formula_by_string(formula_unti_set[i])
                break 

            #set 
            if is_recover_count == 1:
                for i in range(len(formula_set)):
                    self.execute_formula_by_string(formula_set[i])
                    if is_recover_b.get_face(is_recover_color) == 2:
                        set_formula.append(formula_set[i])
                        break
                    self.execute_formula_by_string(formula_unti_set[i])

            #set 
            self.execute_formula_by_string("x'")
            set_formula.append("x'")
            print "set fromula: ", set_formula

            #execute
            exe_formula = "R2 D2 R' U' R D2 R' U R'"
            self.execute_formula_by_string(exe_formula)
            print "execute: ", exe_formula
 
            #unti-set
            self.execute_formula_by_string("x")
            print "unti-set fromula: x"

    def resolver_3st_side_pos(self):
        while True:
            block_list = []

            is_recover_count = 0;
            is_recover_b = ""

            #find
            for b in self._cube.get_block_list():
                if b.get_z() == 1 and b.get_type() == "side" and b.is_recover():
                    is_recover_count = is_recover_count + 1
                    is_recover_b = b


            set_formula = [] 

            #set
            if is_recover_count == 4:
                break

            if is_recover_count == 1:
                if is_recover_b.get_x() == 1:
                    self.execute_formula_by_string("y2")
                    set_formula.append("y2")
                    
                if is_recover_b.get_x() == 0 and is_recover_b.get_y() == -1:
                    self.execute_formula_by_string("y")
                    set_formula.append("y")
                    
                if is_recover_b.get_x() == 0 and is_recover_b.get_y() == 1:
                    self.execute_formula_by_string("y'")
                    set_formula.append("y'")

            print "set formula: ", set_formula 

            #execute 
            exe_formula = "R U' R U R U R U' R' U' R2"
            self.execute_formula_by_string(exe_formula)
            print "execute: ", exe_formula
 
 
    def resolver_step(self, step):
        if step == "1st_corner":
            self.resolver_1st_corner()
            return
        
        if step == "2st_side":
            self.resolver_2st_side()
            return

        if step == "3st_side_color":
            self.resolver_3st_side_color()
            return

        if step == "3st_corner_color":
            self.resolver_3st_corner_color()
            return
            
        if step == "3st_corner_pos":
            self.resolver_3st_corner_pos()
            return

        if step == "3st_side_pos":
            self.resolver_3st_side_pos()
            return


        self._formula_stack = []

        for max_depth in range(1, 8):
            #print "max_depth: ", max_depth
            if self.depth_first_search(0, max_depth, step):
                break;
   
        #print "turn time: ", self._cube.turn_time
        return self._formula_stack 
    
if __name__ == "__main__":
    magic_cube = MagicCube()
    cubeOpt = CubeOperator(magic_cube)
    #cubeOpt.execute_formula_by_string("R U R' U R U2 R' R U R' U R U2 R'")
    print "Disrupt the cube"
    cubeOpt.execute_formula_by_string("D R' F2 D' L U R' D L' U'")


    #create a cube who has bottom side block only
    magic_cube_cross = copy.deepcopy(magic_cube)
    magic_cube_cross.to_cross_cube()
   
    #step 1, 1st layer side
    print "=====step 1, 1st layer side====="
    cubeRsl = CubeResolver(magic_cube_cross)
    #start = time.clock()
    cubeOpt.execute_formula(cubeRsl.resolver_step("first_cross"))
    cubeOpt.execute_formula(cubeRsl.resolver_step("secend_cross"))
    cubeOpt.execute_formula(cubeRsl.resolver_step("third_cross"))
    cubeOpt.execute_formula(cubeRsl.resolver_step("fouth_cross"))
    
    cubeRsl = CubeResolver(magic_cube)
    #step 2, 1st layer corner
    print "=====step 2, 1st layer corner====="
    cubeRsl.resolver_step("1st_corner")

    #step 3, 2st layer side
    print "=====step 3, 2st layer side====="
    cubeRsl.resolver_step("2st_side")

    #step 4, 3st layer side color
    print "=====step 4, 3st layer side color====="
    cubeRsl.resolver_step("3st_side_color")

    #step 5, 3st layer corner color
    print "=====step 5, 3st layer corner color====="
    cubeRsl.resolver_step("3st_corner_color")
    
    #step 6, 3st layer corner pos
    print "=====step 6, 3st layer corner pos====="
    cubeRsl.resolver_step("3st_corner_pos")

    #step 7, 3st layer side pos
    print "=====step 6, 3st layer side pos====="
    cubeRsl.resolver_step("3st_side_pos")


    #elapsed = (time.clock() - start)
    magic_cube.print_cube()

    #print "title time: ", elapsed
