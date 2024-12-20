const { connectToMongoDB, initMongoDB, initCollection } = require('../config/db.js');

const sendMessage = async (req, res) => {
    const { sender, message } = req.body;
    try {
        const databaseName = await initMongoDB();
        const messageCollection = await initCollection(databaseName);
        const result = await messageCollection.insertOne({ sender, message });
        
        if (!result.acknowledged) {
            return res.status(400).json({ message: 'Error sending message' });
        }
        
        return res.status(200).json({ message: 'Message sent successfully' });
        
    } catch (err) {
        console.log(err);
        return res.status(500).json({ message: "Internal Server Error" });
    }
};

//--------------------------------------get--message--------------------------------------------
const getMessage = async (req, res) => {
    const { from } = req.body;
    
    try {
        const databaseName = await initMongoDB();
        const messageCollection = await initCollection(databaseName);
        
        
        const result = await messageCollection.find({ sender: from }).toArray();
        
        return res.status(200).json({ messages: result });
    } catch (err) {
        console.log(err);
        return res.status(500).json({ message: "Internal Server Error" });
    }
}

module.exports = {
    sendMessage,
    getMessage,
};