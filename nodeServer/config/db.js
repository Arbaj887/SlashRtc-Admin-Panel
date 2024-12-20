const {MongoClient}  = require('mongodb')


const connectToMongoDB = async () => {
  try {
    const conn = await MongoClient.connect(process.env.MONGODB_URL);
    console.log("mongoDb connected...")
    return conn;
  } catch (error) {
    console.error("Error connecting to MongoDB:", error);
    throw error;
  }
};


const initMongoDB = async () => {
  const conn = await connectToMongoDB();
  const databaseName = conn.db("slashrtc_admin_panel");
  return databaseName;
};


const initCollection = async (databaseName) => {
  const collection = databaseName.collection("message");
  return collection;
};


module.exports={
  connectToMongoDB,
  initMongoDB,
  initCollection
}

