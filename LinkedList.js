
//creates Node
function Node(x) {
    this.data = x;
    this.prev = null;
    this.neighbor = null;
}

//CREATES doubly linked list
function LinkedList() {
    this.size = 0;
    this.head = null;
    this.tail = null;
}

//CONSTRUCTS methods and functionality of the linked list
LinkedList.prototype = {
    constructor: LinkedList,
    addEnd : function(x){
        let photo = new Node(x);
        let current = this.head;
        if (this.size == 0) {
            this.head = photo;
            this.tail = photo;
            this.size++;
            return this.head;
        }else {
            while(current.neighbor) {
                current = current.neighbor;
            }
            current.neighbor = photo;
            this.size++;
        }
        return this.head;
    },
    sizeOfList : function(){
      return this.size;  
    },
    empty: function(){
        if (this.size == 0) {
            return true;
        }
        return false;
    },
    endNode: function(){
        let current = this.head;
        if (this.size == 0) {
            return this.head;
        }else {
            while(current.neighbor) {
                current = current.neighbor;
            }
            return current;
        }
    }
    
}
        