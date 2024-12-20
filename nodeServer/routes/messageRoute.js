const route = require('express').Router();
const {sendMessage,getMessage} =require('../controllers/messageController.js')
route.route('/sendmessage').post(sendMessage);
route.route('/getmessage').post(getMessage);

module.exports=route;