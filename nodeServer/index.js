const express = require('express')
const app = express()
const cors= require('cors')
const { Server} = require('socket.io')
const { connectToMongoDB,}=require('./config/db.js');
const messageRoute=require('./routes/messageRoute.js');

require('dotenv').config()

app.use(cors());

app.use(express.urlencoded({extended:true}))
app.use(express.json())
app.use('/',messageRoute);

connectToMongoDB(); //---------------------------------------MongoDb--connection-----------------------------------
const server= app.listen(process.env.PORT ,()=>{
    console.log('server is running on port',process.env.PORT )
})

const io = new Server(server,{
    cors:{
    origin: process.env.CORS,
    
    credentials:true
  
    }
   
  })
  io.on('connection',(socket)=>{
   
  
     socket.on('join', function (data) {
      
      socket.join(data.data);
     })
  
     socket.on('send_message',async (data)=>{
       
       
     socket.broadcast.emit('receive_message', data.message);
      
     })
  
  })